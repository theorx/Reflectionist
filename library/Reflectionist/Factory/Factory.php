<?php

namespace Reflectionist\Factory;

use Reflectionist\Comment\CommentBlock;
use Reflectionist\Interfaces\IFactory;
use Reflectionist\Reflection\Parser\ClassParser;
use Reflectionist\Reflection\Parser\ConstantParser;
use Reflectionist\Reflection\Parser\FunctionParser;
use Reflectionist\Reflection\Parser\ParameterParser;
use Reflectionist\Reflection\Parser\PropertyParser;

/**
 * Class Factory
 * @package Reflectionist\Factory
 */
class Factory implements IFactory {

	public static function getAnalyzer() {
		// TODO: Implement getAnalyzer() method.
	}

	/**
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
	 * @return CommentBlock
	 */
	public static function getCommentBlock() {

		return new CommentBlock();
	}
}
