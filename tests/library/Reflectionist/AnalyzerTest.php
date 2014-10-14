<?php

namespace Tests\Reflectionist;

use \Reflectionist\Analyzer;
use Reflectionist\Factory\Factory;

/**
 * Class AnalyzerTest
 * @coversDefaultClass Reflectionist\Analyzer
 * @package            Tests\Reflectionist
 */
class AnalyzerTest extends \PHPUnit_Framework_TestCase {


	/**
	 * @var Analyzer
	 */
	protected $analyzer = null;

	/**
	 * @covers ::__construct
	 */
	public function setUp() {

		parent::setUp();
		$this->analyzer = new Analyzer();
	}

	/**
	 * @covers ::__construct
	 * @covers ::analyze
	 * @covers ::getResult
	 * @covers ::addClass
	 * @covers ::setResult
	 * @covers ::addClass
	 * @covers ::getClasses
	 */
	public function testAnalyzeSetsResult() {

		$result = $this->analyzer->addClass(get_class($this->analyzer))->analyze()->getResult();
		//Check if the parsed class results are present
		//No point in checking all inner nodes since other tests cover these
		$this->assertArrayHasKey(get_class($this->analyzer), $result);
	}

	/**
	 * @covers ::getResult
	 * @covers ::setResult
	 */
	public function testGetSetResultReturnsResult() {

		$this->analyzer->setResult(['test' => 'result']);
		$this->assertEquals(['test' => 'result'], $this->analyzer->getResult());
	}

	/**
	 * @covers ::getClassParser
	 */
	public function testGetClassParserReturnsClassParser() {

		$classParser = $this->analyzer->getClassParser();
		$this->assertInstanceOf('Reflectionist\Reflection\Parser\ClassParser', $classParser);
	}

	/**
	 * @covers ::setClasses
	 * @covers ::getClasses
	 */
	public function testGetSetClassesReturnsClasses() {

		$data = ['class1', 'class2', 'class3'];
		$this->analyzer->setClasses($data);
		$this->assertEquals($data, $this->analyzer->getClasses());
	}

	/**
	 * @covers ::setClassParser
	 * @covers ::getClassParser
	 */
	public function testSetClassParser() {

		$classParser = Factory::getClassParser();
		$this->analyzer->setClassParser($classParser);
		$this->assertEquals($classParser, $this->analyzer->getClassParser());
	}

	/**
	 * @covers ::addClasses
	 * @covers ::getClasses
	 */
	public function testAddClassesAndTestAppending() {

		$this->analyzer->addClasses(['a', 'b']);
		$this->analyzer->addClasses(['c', 'd']);
		$this->assertEquals(['a', 'b', 'c', 'd'], $this->analyzer->getClasses());
	}
}
