<?php

namespace Reflectionist\Reflection\Parser;

/**
 * Class ConstantParser
 * @package Reflectionist\Reflection\Parser
 */
class ConstantParser extends AbstractParser {
	/**
	 * @var mixed
	 */
	private $result;
	/**
	 * @var
	 */
	private $constant;

	/**
	 * @return mixed|void
	 */
	public function parse() {

		echo "	Constant [" . key($this->getConstant()) . "]" . PHP_EOL;

		$this->setResult($this->getConstant());

		return $this;
	}

	/**
	 * @param $constant
	 *
	 * @internal param \ReflectionMethod $function
	 *
	 * @return $this
	 */
	public function setConstant($constant) {

		$this->constant = $constant;

		return $this;
	}

	/**
	 * @return \ReflectionMethod
	 */
	public function getConstant() {

		return $this->constant;
	}

	/**
	 * @param mixed $result
	 *
	 * @return $this
	 */
	public function setResult($result) {

		$this->result = $result;

		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getResult() {

		return $this->result;
	}


}