<?php

namespace Reflectionist\Reflection\Parser;

/**
 * Class ParameterParser
 * @package Reflectionist\Reflection\Parser
 */
class ParameterParser extends AbstractParser {
	/**
	 * @var mixed
	 */
	private $result;

	/**
	 * @var \ReflectionParameter
	 */
	private $parameter;

	/**
	 *
	 */
	public function __construct() {

	}

	/**
	 * @return mixed|void
	 */
	public function parse() {

		echo "			 [" .
			$this->getTypeHint() . "][" .
			$this->getParameter()->getName() . "][" .
			(($this->getParameter()->isOptional() == true) ? 'Optional' : 'Required') .
			"]" . PHP_EOL;
		$this->setResult($this->getParameter());

		//parse DocBlock

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getTypeHint() {

		$type = null;
		if ($this->getParameter()->isArray()) {
			$type = 'Array';
		}

		if ($this->getParameter()->isCallable()) {
			$type = 'Callable';
		}

		if (is_object($this->getParameter()->getClass())) {
			$type = $this->getParameter()->getClass()->getName();
		}

		return $type;
	}

	/**
	 * @param $parameter
	 *
	 * @internal param \ReflectionProperty $property
	 *
	 * @return $this
	 */
	public function setParameter($parameter) {

		$this->parameter = $parameter;

		return $this;
	}

	/**
	 * @return \ReflectionParameter
	 */
	public function getParameter() {

		return $this->parameter;
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