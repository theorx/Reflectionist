<?php

namespace Reflectionist\Comment;

/**
 * Class CommentBlock
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 *
 * @package Reflectionist\Comment
 */
class CommentBlock {

	/**
	 * @var string
	 */
	private $phpDoc;

	/**
	 * @var mixed
	 */
	private $result;

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 */
	public function parse() {

		//parse shit..

		$result = [];
		$tags   = [];
		//remove comment tags
		$result = explode(PHP_EOL, str_replace(['/**', '/*', '*/', '*', '//', '#'], '', $this->getPhpDoc()));

		foreach ($result as $key => $value) {
			$result[$key] = ltrim(trim($value));
		}

		//find short description
		//find long description

		//get all tags
		$tagCapture = false;
		foreach ($result as $key => $value) {
			if (strlen($value) > 0 && $value[0] == '@') {
				$parts = explode(' ', $value);
				$tag   = $parts[0];
				unset($parts[0]);
				$tags[$tag] = implode(' ', $parts);
			}
		}

		$result += $tags;

		$this->setResult($result);


		print_r($result);
		exit;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $phpDoc
	 *
	 * @return $this
	 */
	public function setPhpDoc($phpDoc) {

		$this->phpDoc = $phpDoc;

		return $this;

	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return mixed
	 */
	public function getPhpDoc() {

		return $this->phpDoc;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param mixed $result
	 *
	 * @return $this
	 */
	public function setResult($result) {

		$this->result = $result;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return mixed
	 */
	public function getResult() {

		return $this->result;
	}
}
