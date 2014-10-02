<?php
namespace Tests\Reflectionist\Comment;

use Reflectionist\Comment\CommentBlock;

/**
 * Class CommentBlockTest
 *
 * @author             Lauri Orgla <TheOrX@hotmail.com>
 * @coversDefaultClass Reflectionist\Comment\CommentBlock
 * @package            Tests\Reflectionist
 */
class CommentBlockTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @var CommentBlock
	 */
	protected $commentBlock;

	/**
	 *
	 */
	public function setUp() {

		parent::setUp();
		$this->commentBlock = new CommentBlock();
	}

	/**
	 * @covers ::setResult
	 * @covers ::getResult
	 */
	public function testGetSetResultReturnsResult() {

		$this->commentBlock->setResult(['my' => 'result']);
		$this->assertEquals(['my' => 'result'], $this->commentBlock->getResult());
	}

	/**
	 * @covers ::setPhpDoc
	 * @covers ::getPhpDoc
	 */
	public function testGetSetPhpDocReturnsPhpDoc() {

		$this->commentBlock->setPhpDoc('Some string containing phpdoc...');
		$this->assertEquals('Some string containing phpdoc...', $this->commentBlock->getPhpDoc());
	}

	/**
	 * @covers ::trimPhpDoc
	 */
	public function testTrimPhpDocReturnsTrimmedArray() {

		$phpDoc = [
			'First String ',
			' Second String',
			' 	Third String 	 	'
		];

		$this->commentBlock->trimPhpDoc($phpDoc);

		$this->assertEquals('First String', $phpDoc[0]);
		$this->assertEquals('Second String', $phpDoc[1]);
		$this->assertEquals('Third String', $phpDoc[2]);
	}

	/**
	 * @covers ::parse
	 * @covers ::setResult
	 * @covers ::trimPhpDoc
	 * @covers ::fetchTagsFromPhpDoc
	 * @covers ::fetchDescriptions
	 */
	public function testParseParsesPhpDoc() {

		$this->commentBlock->setPhpDoc('/**
 * Class CommentBlockTest
 *
 * This is a long Description, this could also be
 * Multilined.
 *
 * @coversDefaultClass Reflectionist\Comment\CommentBlock
 * @package            Tests\Reflectionist
 */');

		$this->commentBlock->parse();
		$result = $this->commentBlock->getResult();

		$this->assertArrayHasKey('shortDescription', $result);
		$this->assertArrayHasKey('longDescription', $result);
		$this->assertArrayHasKey('tags', $result);
		$this->assertEquals('Class CommentBlockTest', $result['shortDescription']);
		$this->assertEquals('This is a long Description, this could also be' . PHP_EOL . 'Multilined.' . PHP_EOL,
			$result['longDescription']);
		$this->assertEquals([
			'@coversDefaultClass' => [
				0 => 'Reflectionist\Comment\CommentBlock'
			],
			'@package'            => [
				0 => 'Tests\Reflectionist'
			]
		], $result['tags']);
	}

	/**
	 * @covers ::fetchDescriptions
	 */
	public function testFetchDescriptionsFromPhpDocReturnsShortAndLongDescription() {

		$input = [
			'Short description..',
			'',
			'Long Descriptiopn',
			'Long description second row..',
			'Third row..'
		];
		$this->commentBlock->fetchDescriptions($input, $shortDescription, $longDescription);
		$this->assertEquals('Short description..', $shortDescription);
		$this->assertEquals('Long Descriptiopn' . PHP_EOL . 'Long description second row..' . PHP_EOL .
			'Third row..' . PHP_EOL, $longDescription);
	}
}