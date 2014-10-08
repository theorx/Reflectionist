<?php
namespace Tests\Reflectionist\Reflection\Parser;

use Reflectionist\Reflection\Parser\MethodParser;
use Tests\Stubs\StubAccessTypesClass;


/**
 * Class MethodParserTest
 * @author             Lauri Orgla <TheOrX@hotmail.com>
 *
 * @coversDefaultClass Reflectionist\Reflection\Parser\MethodParser
 * @package            Tests\Reflectionist
 */
class MethodParserTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var MethodParser
	 */
	protected $methodParser = null;

	/**
	 */
	public function setUp() {

		parent::setUp();
		$this->methodParser = new MethodParser();
	}

	/**
	 * @covers ::getResult
	 * @covers ::setResult
	 */
	public function testGetSetResultReturnsResult() {

		$this->methodParser->setResult(['My' => 'Result']);
		$this->assertEquals(['My' => 'Result'], $this->methodParser->getResult());
	}

	/**
	 * @covers ::setMethod
	 * @covers ::getMethod
	 */
	public function testGetSetMethodReturnsMethod() {

		$reflectionMethod = new \ReflectionMethod('Reflectionist\Reflection\Parser\MethodParser', 'getResult');
		$this->methodParser->setMethod($reflectionMethod);
		$this->assertEquals($reflectionMethod, $this->methodParser->getMethod());
	}

	/**
	 * @return array
	 */
	public function provideAccessMethodsAndTypes() {

		return [
			['publicMethod', 'public'],
			['privateMethod', 'private'],
			['protectedMethod', 'protected'],
			['staticMethod', 'public static'],
			['publicStaticMethod', 'public static'],
			['privateStaticMethod', 'private static'],
			['protectedStaticMethod', 'protected static']
		];
	}

	/**
	 * @param $methodName
	 * @param $accessType
	 *
	 * @dataProvider provideAccessMethodsAndTypes
	 * @covers ::getAccessType
	 */
	public function testGetAccessTypeReturnsTypeAsString($methodName, $accessType) {

		$reflectionClass = new \ReflectionClass(new StubAccessTypesClass());

		foreach ($reflectionClass->getMethods() as $method) {
			if ($method->getName() == $methodName) {
				$this->assertEquals(
					 $accessType,
						 $this->methodParser->setMethod($method)->getAccessType()
				);

				return;
			}
		}

		$this->markTestSkipped('Method was not found');
	}

	/**
	 * @covers ::parse
	 */
	public function testParseSetsResultArray() {

		$reflectionClass = new \ReflectionClass(new StubAccessTypesClass());
		foreach ($reflectionClass->getMethods() as $method) {
			$result = $this->methodParser->setMethod($method)->parse()->getResult();
			$this->assertArrayHasKey('accessType', $result);
			$this->assertEquals($this->methodParser->getAccessType(), $result['accessType']);
			$this->assertArrayHasKey('name', $result);
			$this->assertEquals($method->getName(), $result['name']);
			$this->assertArrayHasKey('parameters', $result);
			$this->assertEquals($method->getParameters(), $result['parameters']);
			$this->assertArrayHasKey('numberOfParameters', $result);
			$this->assertEquals($method->getNumberOfParameters(), $result['numberOfParameters']);
			$this->assertArrayHasKey('numberOfRequiredParameters', $result);
			$this->assertEquals($method->getNumberOfRequiredParameters(), $result['numberOfRequiredParameters']);
			$this->assertArrayHasKey('methodStaticVariables', $result);
			$this->assertEquals($method->getStaticVariables(), $result['methodStaticVariables']);
			$this->assertArrayHasKey('phpdoc', $result);
			$this->assertArrayHasKey('shortDescription', $result['phpdoc']);
			$this->assertArrayHasKey('longDescription', $result['phpdoc']);
			$this->assertArrayHasKey('tags', $result['phpdoc']);
		}
	}
}
