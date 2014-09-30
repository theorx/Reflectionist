<?php
namespace Tests\Reflectionist;

use Reflectionist\Factory\Factory;
use Reflectionist\Reflection\Parser\ClassParser;
use Reflectionist\Reflection\Parser\ConstantParser;
use Reflectionist\Reflection\Parser\FunctionParser;
use Reflectionist\Reflection\Parser\ParameterParser;
use Reflectionist\Reflection\Parser\PropertyParser;

/**
 * Class AnalyzerTest
 * @coversDefaultClass Reflectionist\Reflection\Parser\ClassParser
 * @package            Tests\Reflectionist
 */
class ClassParserTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var ClassParser
	 */
	protected $classParser = null;

	/**
	 * @covers ::__construct
	 */
	public function setUp() {

		parent::setUp();
		$this->classParser = Factory::getClassParser();
	}


	/**
	 * @covers ::getParameterParser
	 * @covers ::setParameterParser
	 */
	public function testGetSetParameterParserReturnsParser() {

		$parameterParser = new ParameterParser();
		$this->classParser->setParameterParser($parameterParser);
		$this->assertEquals($parameterParser, $this->classParser->getParameterParser());
	}

	/**
	 * @covers ::getConstantParser
	 * @covers ::setConstantParser
	 */
	public function testGetSetConstantParserReturnsParser() {

		$constantParser = new ConstantParser();
		$this->classParser->setConstantParser($constantParser);
		$this->assertEquals($constantParser, $this->classParser->getConstantParser());
	}


	/**
	 * @covers ::getPropertyParser
	 * @covers ::setPropertyParser
	 */
	public function testGetSetPropertyParserReturnsParser() {

		$propertyParser = new PropertyParser();
		$this->classParser->setPropertyParser($propertyParser);
		$this->assertEquals($propertyParser, $this->classParser->getPropertyParser());
	}

	/**
	 * @covers ::getFunctionParser
	 * @covers ::setFunctionParser
	 */
	public function testGetSetFunctionParserReturnsParser() {

		$functionParser = new FunctionParser();
		$this->classParser->setFunctionParser($functionParser);
		$this->assertEquals($functionParser, $this->classParser->getFunctionParser());
	}

	/**
	 * @covers ::getClass
	 * @covers ::setClass
	 */
	public function testGetSetClassReturnsClass() {

		$this->classParser->setClass("\\path\\to\\my\\class");
		$this->assertEquals("\\path\\to\\my\\class", $this->classParser->getClass());
	}

	/**
	 * @covers ::getResult
	 * @covers ::setResult
	 */
	public function testGetSetResultReturnsResult() {

		$this->classParser->setResult(['a' => 'b', 'this' => 'is result']);
		$this->assertEquals(['a' => 'b', 'this' => 'is result'], $this->classParser->getResult());
	}

	/**
	 * @covers ::parse
	 */
	public function testParseRunsParseMethods() {

		$mock = $this->getMock('Reflectionist\Reflection\Parser\ClassParser', ['parseClass', 'parseProperties', 'parseMethods', 'parseConstants'], [], '', false);
		$mock->expects($this->once())->method('parseClass')->with($this->anything(), $this->anything());
		$mock->expects($this->once())->method('parseProperties')->with($this->anything(), $this->anything());
		$mock->expects($this->once())->method('parseMethods')->with($this->anything(), $this->anything());
		$mock->expects($this->once())->method('parseConstants')->with($this->anything(), $this->anything());

		$mock->setClass('\PDO');
		$mock->parse();
	}

	/**
	 * @covers ::parse
	 * @expectedException \Exception
	 */
	public function testParseSetInvalidClassThrowsException() {

		$this->classParser->setClass('random_bad_class');
		$this->classParser->parse();
	}


}