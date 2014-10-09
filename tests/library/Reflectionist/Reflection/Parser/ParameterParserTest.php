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
	public function provideParameterNumberAndTypeHint() {

		return [
			[0, 'Callable'],
			[1, 'Array'],
			[2, null],
			[3, 'PDO'],
		];
	}

	/**
	 * @param $parameterNumber
	 * @param $typeHint
	 *
	 *
	 * @dataProvider provideParameterNumberAndTypeHint
	 * @covers ::getTypeHint
	 */
	public function testGetTypeHintReturnsTypeAsString($parameterNumber, $typeHint) {

		$reflectionParameter = new \ReflectionParameter(['Tests\Stubs\StubAccessTypesClass', 'testParameters'], $parameterNumber);
		$this->assertEquals(
			 $typeHint,
				 $this->parameterParser->setParameter($reflectionParameter)->getTypeHint()
		);
	}

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
