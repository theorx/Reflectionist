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

		$this->setResult(['phpdoc' => 'result']);

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
