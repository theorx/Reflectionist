<?php

namespace Reflectionist\Reflection\Parser;

/**
 * Class PropertyParser
 * @package Reflectionist\Reflection\Parser
 */
class PropertyParser extends AbstractParser {
	/**
	 * @var mixed
	 */
	private $result;

	/**
	 * @var \ReflectionProperty
	 */
	private $property;

	/**
	 *
	 */
	public function __construct() {

	}

	/**
	 * @return mixed|void
	 */
	public function parse() {

		echo "	Property [" . $this->getAccessType() . "][" . $this->getProperty()->getName() . "]" . PHP_EOL;
		$this->setResult($this->getProperty());

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAccessType() {

		$type = [];
		if ($this->getProperty()->isPrivate()) {
			$type[] = 'private';
		}
		if ($this->getProperty()->isPublic()) {
			$type[] = 'public';
		}
		if ($this->getProperty()->isProtected()) {
			$type[] = 'protected';
		}
		if ($this->getProperty()->isStatic()) {
			$type[] = 'static';
		}

		return implode(' ', $type);
	}

	/**
	 * @param \ReflectionProperty $property
	 *
	 * @return $this
	 */
	public function setProperty($property) {

		$this->property = $property;

		return $this;
	}

	/**
	 * @return \ReflectionProperty
	 */
	public function getProperty() {

		return $this->property;
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