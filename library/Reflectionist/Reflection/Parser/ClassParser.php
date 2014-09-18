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
	private $result = [
		'class'      => null,
		'methods'    => null,
		'properties' => null
	];

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
	 * @var null
	 */
	private $constantParser = null;


	/**
	 * @param FunctionParser $functionParser
	 * @param PropertyParser $propertyParser
	 * @param ConstantParser $constantParser
	 */
	public function __construct(FunctionParser $functionParser = null, PropertyParser $propertyParser = null, ConstantParser $constantParser) {

		$this->setFunctionParser($functionParser);
		$this->setPropertyParser($propertyParser);
		$this->setConstantParser($constantParser);
	}

	/**
	 * @throws \Reflectionist\Exception\ClassException
	 */
	public function parse() {

		$result = [];
		//do some exception handling, when class is not found.. or something
		if (!class_exists($this->getClass(), true)) {
			throw new ClassException($this->getClass());
		}

		$reflection = new \ReflectionClass($this->getClass());

		foreach ($reflection->getMethods() as $method) {
			$result['methods'][$method->name] = $this->getFunctionParser()->setFunction($method)->parse()->getResult();
		}

		foreach ($reflection->getProperties() as $property) {
			$result['properties'][$property->name] = $this->getPropertyParser()->setProperty($property)->parse()->getResult();
		}

		foreach ($reflection->getConstants() as $constantName => $constantValue) {
			$result['constants'][$constantName] = $this->getConstantParser()->setConstant([$constantName => $constantValue])->parse()->getResult();
		}


		$this->setResult($result);

		return $this;
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
	 * @param mixed $result
	 */
	public function setResult($result) {

		$this->result = $result;
	}

	/**
	 * @return mixed
	 */
	public function getResult() {

		return $this->result;
	}

	/**
	 * @param ConstantParser $constantParser
	 */
	public function setConstantParser($constantParser) {

		$this->constantParser = $constantParser;
	}

	/**
	 * @return ConstantParser
	 */
	public function getConstantParser() {

		return $this->constantParser;
	}

}