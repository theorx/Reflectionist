<?php

namespace Reflectionist\Interfaces;

/**
 * Interface IFactory
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 *
 * @package Reflectionist\Interfaces
 */
interface IFactory {
	/**
	 * @return mixed
	 */
	public static function getAnalyzer();

	/**
	 * @return mixed
	 */
	public static function getClassParser();

	/**
	 * @return mixed
	 */
	public static function getCommentBlock();
}
