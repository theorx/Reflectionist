<?php

namespace Reflectionist\Reflection\Parser;

/**
 * Class ConstantParser
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 * @package Reflectionist\Reflection\Parser
 */
class ConstantParser extends AbstractParser {

	/**
	 * @var mixed mixed
	 */
	private $result;

	/**
	 * @var mixed
	 */
	private $constant;

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return mixed|void
	 */
	public function parse() {

		$this->setResult($this->getConstant());

		return $this;
	}

	/**
	 * @author   Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $constant
	 *
	 * @internal param mixed $function
	 *
	 * @return $this
	 */
	public function setConstant($constant) {

		$this->constant = $constant;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return mixed
	 */
	public function getConstant() {

		return $this->constant;
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
