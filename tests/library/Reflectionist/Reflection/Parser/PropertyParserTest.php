<?php
namespace Tests\Reflectionist\Reflection\Parser;

use Reflectionist\Reflection\Parser\PropertyParser;
use Tests\Stubs\StubAccessTypesClass;


/**
 * Class PropertyParserTest
 * @author             Lauri Orgla <TheOrX@hotmail.com>
 *
 * @coversDefaultClass Reflectionist\Reflection\Parser\PropertyParser
 * @package            Tests\Reflectionist
 */
class PropertyParserTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var PropertyParser
	 */
	protected $propertyParser = null;

	/**
	 */
	public function setUp() {

		parent::setUp();
		$this->propertyParser = new PropertyParser();
	}

	/**
	 * @covers ::getResult
	 * @covers ::setResult
	 */
	public function testGetSetResultReturnsResult() {

		$this->propertyParser->setResult(['My' => 'Result']);
		$this->assertEquals(['My' => 'Result'], $this->propertyParser->getResult());
	}

	/**
	 * @covers ::setProperty
	 * @covers ::getProperty
	 */
	public function testGetSetPropertyReturnsProperty() {

		$reflectionProperty = new \ReflectionProperty('Reflectionist\Reflection\Parser\PropertyParser', 'result');
		$this->propertyParser->setProperty($reflectionProperty);
		$this->assertEquals($reflectionProperty, $this->propertyParser->getProperty());
	}

	/**
	 * @return array
	 */
	public function provideAccessPropertiesAndTypes() {

		return [
			['publicProperty', 'public'],
			['privateProperty', 'private'],
			['protectedProperty', 'protected'],
			['publicStaticProperty', 'public static'],
			['privateStaticProperty', 'private static'],
			['protectedStaticProperty', 'protected static']
		];
	}

	/**
	 * @param $propertyName
	 * @param $accessType
	 *
	 * @dataProvider provideAccessPropertiesAndTypes
	 * @covers ::getAccessType
	 */
	public function testGetAccessTypeReturnsTypeAsString($propertyName, $accessType) {

		$reflectionClass = new \ReflectionClass(new StubAccessTypesClass());

		foreach ($reflectionClass->getProperties() as $method) {
			if ($method->getName() == $propertyName) {
				$this->assertEquals(
					 $accessType,
						 $this->propertyParser->setProperty($method)->getAccessType()
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
		foreach ($reflectionClass->getProperties() as $property) {
			$result = $this->propertyParser->setProperty($property)->parse()->getResult();
			$this->assertArrayHasKey('accessType', $result);
			$this->assertEquals($this->propertyParser->getAccessType(), $result['accessType']);
			$this->assertArrayHasKey('name', $result);
			$this->assertEquals($property->getName(), $result['name']);
			$this->assertArrayHasKey('value', $result);
			$this->assertEquals(null, $result['value']);
			$this->assertArrayHasKey('phpdoc', $result);
			$this->assertArrayHasKey('shortDescription', $result['phpdoc']);
			$this->assertArrayHasKey('longDescription', $result['phpdoc']);
			$this->assertArrayHasKey('tags', $result['phpdoc']);
		}
	}

}
