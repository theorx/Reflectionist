<?php
namespace Tests\Reflectionist\Reflection\Parser;

use Reflectionist\Reflection\Parser\ConstantParser;
use Tests\Stubs\StubAccessTypesClass;


/**
 * Class ConstantParserTest
 * @author             Lauri Orgla <TheOrX@hotmail.com>
 *
 * @coversDefaultClass Reflectionist\Reflection\Parser\ConstantParser
 * @package            Tests\Reflectionist
 */
class ConstantParserTest extends \PHPUnit_Framework_TestCase {

	/**
	 * @var ConstantParser
	 */
	protected $constantParser = null;

	/**
	 */
	public function setUp() {

		parent::setUp();
		$this->constantParser = new ConstantParser();
	}

	/**
	 * @covers ::getResult
	 * @covers ::setResult
	 */
	public function testGetSetResultReturnsResult() {

		$this->constantParser->setResult(['My' => 'Result']);
		$this->assertEquals(['My' => 'Result'], $this->constantParser->getResult());
	}

	/**
	 * @covers ::setConstant
	 * @covers ::getConstant
	 */
	public function testGetSetConstantReturnsConstant() {

		$this->constantParser->setConstant(['my' => 'constant']);
		$this->assertEquals(['my' => 'constant'], $this->constantParser->getConstant());
	}

	/**
	 * @covers ::parse
	 * @covers ::setConstant
	 * @covers ::getConstant
	 */
	public function testParseConstant() {

		$constant = ['test' => 'test value'];
		$result   = $this->constantParser->setConstant($constant)->parse()->getResult();
		$this->assertEquals($constant, $result);
	}
}
