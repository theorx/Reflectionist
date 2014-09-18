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

		echo "			 [" . $this->getParameter()->getName() . "][" . (($this->getParameter()->isOptional()==true)?'Optional':'Required') . "]" . PHP_EOL;
		$this->setResult($this->getParameter());

		return $this;
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