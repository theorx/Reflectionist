<?php
namespace Reflectionist\Factory;

use Reflectionist\Analyzer;
use Reflectionist\Comment\CommentBlock;
use Reflectionist\Interfaces\IFactory;
use Reflectionist\Reflection\Parser\ClassParser;
use Reflectionist\Reflection\Parser\ConstantParser;
use Reflectionist\Reflection\Parser\FunctionParser;
use Reflectionist\Reflection\Parser\ParameterParser;
use Reflectionist\Reflection\Parser\PropertyParser;

/**
 * Class Factory
 *
 * Usage: Factory::getClassParser();
 * Returns instance of the objects.
 *
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 *
 * @package Reflectionist\Factory
 */
class Factory implements IFactory {

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return mixed|Analyzer
	 */
	public static function getAnalyzer() {

		return new Analyzer();
	}

	/**
	 * This function builds and returns ClassParser
	 *
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return ClassParser
	 */
	public static function getClassParser() {

		return new ClassParser(
			new FunctionParser(),
			new PropertyParser(),
			new ConstantParser(),
			new ParameterParser()
		);
	}

	/**
	 * This function returns instance of CommentBlock
	 *
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return CommentBlock
	 */
	public static function getCommentBlock() {

		return new CommentBlock();
	}
}
