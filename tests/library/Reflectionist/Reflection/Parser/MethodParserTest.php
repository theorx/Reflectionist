<?php
namespace Tests\Reflectionist\Reflection\Parser;

use Reflectionist\Reflection\Parser\MethodParser;


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


}
