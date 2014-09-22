<?php

namespace Reflectionist\Reflection\Parser;

/**
 * Class ParameterParser
 * @author  Lauri Orgla <TheOrX@hotmail.com>
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
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 */
	public function __construct() {

	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return $this|mixed
	 */
	public function parse() {

		$this->setResult([
			'name'         => $this->getParameter()->getName(),
			'type'         => $this->getTypeHint(),
			'isOptional'   => $this->getParameter()->isOptional(),
			'position'     => $this->getParameter()->getPosition(),
			'defaultValue' => ($this->getParameter()->isOptional()) ? $this->getParameter()->getDefaultValue() : null
		]);

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
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
	 * @author   Lauri Orgla <TheOrX@hotmail.com>
	 *
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
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return \ReflectionParameter
	 */
	public function getParameter() {

		return $this->parameter;
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
