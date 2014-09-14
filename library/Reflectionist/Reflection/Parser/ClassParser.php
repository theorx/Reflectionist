<?php
namespace Reflectionist\Reflection\Parser;

use Reflectionist\Exception\ClassException;

/**
 * Class ClassParser
 * @package Reflectionist\Reflection\Parser
 */
class ClassParser extends AbstractParser {

	/**
	 * @var null
	 */
	private $result = null;

	/**
	 * @var null
	 */
	private $class = null;

	/**
	 * @var null
	 */
	private $functionParser = null;

	/**
	 * @var null
	 */
	private $propertyParser = null;


	/**
	 * @param FunctionParser $functionParser
	 * @param PropertyParser $propertyParser
	 */
	public function __construct(FunctionParser $functionParser = null, PropertyParser $propertyParser = null) {

		$this->setFunctionParser($functionParser);
		$this->setPropertyParser($propertyParser);
	}

	/**
	 * @throws \Reflectionist\Exception\ClassException
	 */
	public function parse() {

		//do some exception handling, when class is not found.. or something
		if (!class_exists($this->getClass(), true)) {
			throw new ClassException($this->getClass());
		}

		$reflection = new \ReflectionClass($this->getClass());

		print_r($reflection);
		//get all defaultProperties
		//get property accessor
		//get property docblock and parse it
		//get property default value


		//get all methods
		//get method docblock and parse it
		//get method accessor
		//get method arguments
		//get argument default value and typehint

		return $reflection;
	}

	/**
	 * @param $class
	 *
	 * @return $this
	 */
	public function setClass($class) {

		$this->class = $class;

		return $this;
	}

	/**
	 * @return null
	 */
	public function getClass() {

		return $this->class;
	}

	/**
	 * @param FunctionParser $functionParser
	 */
	public function setFunctionParser(FunctionParser $functionParser) {

		$this->functionParser = $functionParser;
	}

	/**
	 * @return FunctionParser
	 */
	public function getFunctionParser() {

		return $this->functionParser;
	}

	/**
	 * @param PropertyParser $propertyParser
	 */
	public function setPropertyParser(PropertyParser $propertyParser) {

		$this->propertyParser = $propertyParser;
	}

	/**
	 * @return PropertyParser
	 */
	public function getPropertyParser() {

		return $this->propertyParser;
	}

	/**
	 * @param null $result
	 */
	public function setResult($result) {

		$this->result = $result;
	}

	/**
	 * @return null
	 */
	public function getResult() {

		return $this->result;
	}

}