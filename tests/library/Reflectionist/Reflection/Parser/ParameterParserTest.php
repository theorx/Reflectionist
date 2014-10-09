<?php
namespace Tests\Reflectionist\Reflection\Parser;

use Reflectionist\Reflection\Parser\ParameterParser;
use Tests\Stubs\StubAccessTypesClass;


/**
 * Class ParameterParserTest
 * @author             Lauri Orgla <TheOrX@hotmail.com>
 *
 * @coversDefaultClass Reflectionist\Reflection\Parser\ParameterParser
 * @package            Tests\Reflectionist
 */
class ParameterParserTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var ParameterParser
	 */
	protected $parameterParser = null;

	/**
	 */
	public function setUp() {

		parent::setUp();
		$this->parameterParser = new ParameterParser();
	}

	/**
	 * @covers ::getResult
	 * @covers ::setResult
	 */
	public function testGetSetResultReturnsResult() {

		$this->parameterParser->setResult(['My' => 'Result']);
		$this->assertEquals(['My' => 'Result'], $this->parameterParser->getResult());
	}

	/**
	 * @covers ::setParameter
	 * @covers ::getParameter
	 */
	public function testGetSetParameterReturnsMethod() {

		$reflectionMethod = new \ReflectionParameter(['Tests\Stubs\StubAccessTypesClass', 'testParameters'], 1);
		$this->parameterParser->setParameter($reflectionMethod);
		$this->assertEquals($reflectionMethod, $this->parameterParser->getParameter());
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
	/*public function testGetAccessTypeReturnsTypeAsString($methodName, $accessType) {

		$reflectionClass = new \ReflectionClass(new StubAccessTypesClass());

		foreach ($reflectionClass->getMethods() as $method) {
			if ($method->getName() == $methodName) {
				$this->assertEquals(
					 $accessType,
						 $this->parameterParser->setParameter($method)->getAccessType()
				);

				return;
			}
		}

		$this->markTestSkipped('Method was not found');
	}*/

	/**
	 * @covers ::parse
	 */
	public function testParseSetsResultArray() {

		$reflectionClass = new \ReflectionClass(new StubAccessTypesClass());
		foreach ($reflectionClass->getMethods() as $method) {
			foreach ($method->getParameters() as $parameter) {
				$result = $this->parameterParser->setParameter($parameter)->parse()->getResult();

				$this->assertArrayHasKey('name', $result);
				$this->assertEquals($parameter->getName(), $result['name']);
				$this->assertArrayHasKey('type', $result);
				$this->assertEquals($this->parameterParser->getTypeHint(), $result['type']);
				$this->assertArrayHasKey('isOptional', $result);
				$this->assertEquals($parameter->isOptional(), $result['isOptional']);
				$this->assertArrayHasKey('position', $result);
				$this->assertEquals($parameter->getPosition(), $result['position']);
				$this->assertArrayHasKey('defaultValue', $result);
				$this->assertEquals(
					 ($parameter->isOptional()) ? $parameter->getDefaultValue() : null, $result['defaultValue']
				);
			}
		}
	}
}
