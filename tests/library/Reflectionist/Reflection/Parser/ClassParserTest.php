<?php
namespace Tests\Reflectionist;

use Tests\Stubs\StubReflectionClass;
use Reflectionist\Factory\Factory;
use Reflectionist\Reflection\Parser\ClassParser;
use Reflectionist\Reflection\Parser\ConstantParser;
use Reflectionist\Reflection\Parser\MethodParser;
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
	 * @covers ::getMethodParser
	 * @covers ::setMethodParser
	 */
	public function testGetSetMethodParserReturnsParser() {

		$functionParser = new MethodParser();
		$this->classParser->setMethodParser($functionParser);
		$this->assertEquals($functionParser, $this->classParser->getMethodParser());
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

	/**
	 * @covers ::parseClass
	 */
	public function testParseClassSetsResultNameAndPhpDoc() {

		$reflectionClass = new \ReflectionClass(new StubReflectionClass());
		$this->classParser->parseClass($reflectionClass, $result);

		$this->assertArrayHasKey('class', $result);
		$this->assertArrayHasKey('name', $result['class']);
		$this->assertArrayHasKey('phpdoc', $result['class']);
		$this->assertArrayHasKey('shortDescription', $result['class']['phpdoc']);
		$this->assertArrayHasKey('longDescription', $result['class']['phpdoc']);
		$this->assertArrayHasKey('tags', $result['class']['phpdoc']);
	}

	/**
	 * @covers ::parseProperties
	 */
	public function testParsePropertiesReturnsParsedProperties() {

		$reflectionClass = new \ReflectionClass(new StubReflectionClass());
		$this->classParser->parseProperties($reflectionClass, $result);

		$this->assertArrayHasKey('properties', $result);
		$this->assertArrayHasKey('name', $result['properties']);
		$this->assertArrayHasKey('name', $result['properties']['name']);
		$this->assertArrayHasKey('accessType', $result['properties']['name']);
		$this->assertArrayHasKey('name', $result['properties']['name']);
		$this->assertArrayHasKey('value', $result['properties']['name']);
		$this->assertArrayHasKey('phpdoc', $result['properties']['name']);
		$this->assertArrayHasKey('shortDescription', $result['properties']['name']['phpdoc']);
		$this->assertArrayHasKey('longDescription', $result['properties']['name']['phpdoc']);
		$this->assertArrayHasKey('tags', $result['properties']['name']['phpdoc']);
	}

	/**
	 * @covers ::parseConstants
	 */
	public function testParseConstantsReturnsParsedConstants() {

		$reflectionClass = new \ReflectionClass(new StubReflectionClass());
		$this->classParser->parseConstants($reflectionClass, $result);

		$this->assertArrayHasKey('constants', $result);
		$this->assertArrayHasKey('TEST_CONSTANT', $result['constants']);
		$this->assertArrayHasKey('TEST_CONSTANT', $result['constants']['TEST_CONSTANT']);
		$this->assertEquals('test value', $result['constants']['TEST_CONSTANT']['TEST_CONSTANT']);
	}

	/**
	 * @covers ::parseMethods
	 * @covers ::parseMethodParameters
	 */
	public function testParseMethodsAndMethodParametersReturnsParsedMethodsAndParameters() {

		$reflectionClass = new \ReflectionClass(new StubReflectionClass());
		$this->classParser->parseMethods($reflectionClass, $result);


		$this->assertArrayHaskey('methods', $result);
		$this->assertArrayHaskey('parser', $result['methods']);
		$this->assertArrayHaskey('accessType', $result['methods']['parser']);
		$this->assertEquals('public', $result['methods']['parser']['accessType']);
		$this->assertArrayHaskey('name', $result['methods']['parser']);
		$this->assertEquals('parser', $result['methods']['parser']['name']);
		$this->assertArrayHaskey('parameters', $result['methods']['parser']);
		$this->assertArrayHaskey('numberOfParameters', $result['methods']['parser']);
		$this->assertArrayHaskey('numberOfRequiredParameters', $result['methods']['parser']);
		$this->assertArrayHaskey('methodStaticVariables', $result['methods']['parser']);
		$this->assertArrayHaskey('phpdoc', $result['methods']['parser']);
		$this->assertArrayHaskey('shortDescription', $result['methods']['parser']['phpdoc']);
		$this->assertArrayHaskey('longDescription', $result['methods']['parser']['phpdoc']);
		$this->assertArrayHaskey('tags', $result['methods']['parser']['phpdoc']);
		$this->assertCount(
			 $result['methods']['parser']['numberOfParameters'],
				 $result['methods']['parser']['parameters']
		);
	}
}
