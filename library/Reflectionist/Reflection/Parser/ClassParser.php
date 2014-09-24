<?php
namespace Reflectionist\Reflection\Parser;

use Reflectionist\Exception\ClassException;
use Reflectionist\Factory\Factory;

/**
 * Class ClassParser
 *
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 * @package Reflectionist\Reflection\Parser
 */
class ClassParser extends AbstractParser {

	/**
	 * @var mixed
	 */
	private $result = [];

	/**
	 * @var object
	 */
	private $class = null;

	/**
	 * @var FunctionParser
	 */
	private $functionParser = null;

	/**
	 * @var PropertyParser
	 */
	private $propertyParser = null;

	/**
	 * @var ConstantParser
	 */
	private $constantParser = null;

	/**
	 * @var ParameterParser
	 */
	private $parameterParser = null;

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param FunctionParser  $functionParser
	 * @param PropertyParser  $propertyParser
	 * @param ConstantParser  $constantParser
	 * @param ParameterParser $parameterParser
	 */
	public function __construct(
		FunctionParser $functionParser,
		PropertyParser $propertyParser,
		ConstantParser $constantParser,
		ParameterParser $parameterParser
	) {

		$this->setFunctionParser($functionParser);
		$this->setPropertyParser($propertyParser);
		$this->setConstantParser($constantParser);
		$this->setParameterParser($parameterParser);
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @throws \Reflectionist\Exception\ClassException
	 */
	public function parse() {

		//do some exception handling, when class is not found.. or something
		if (!class_exists($this->getClass(), true)) {
			throw new ClassException($this->getClass());
		}
		$result           = [];
		$reflection       = new \ReflectionClass($this->getClass());
		$result['phpdoc'] = Factory::getCommentBlock()->setPhpDoc($reflection->getDocComment())->parse()->getResult();

		$this->parseClass($reflection, $result);
		$this->parseConstants($reflection, $result);
		$this->parseProperties($reflection, $result);
		$this->parseMethods($reflection, $result);
		$this->setResult($result);

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param \ReflectionClass $reflection
	 * @param                  $result
	 */
	public function parseClass(\ReflectionClass $reflection, &$result) {

		$result['class']['name']   = $reflection->getName();
		$result['class']['phpdoc'] = Factory::getCommentBlock()->setPhpDoc($reflection->getDocComment())->parse()->getResult();
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param \ReflectionClass $reflection
	 * @param                  $result
	 */
	public function parseProperties(\ReflectionClass $reflection, &$result) {

		foreach ($reflection->getProperties() as $property) {
			$result['properties'][$property->name] = $this->getPropertyParser()->setProperty($property)->parse()->getResult();
		}

		foreach ($reflection->getDefaultProperties() as $name => $value) {
			if (isset($result['properties'][$name])) {
				$result['properties'][$name]['defaultValue'] = $value;
			}
		}
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param \ReflectionClass $reflection
	 * @param                  $result
	 */
	public function parseMethods(\ReflectionClass $reflection, &$result) {

		foreach ($reflection->getMethods() as $method) {
			$result['methods'][$method->name] = $this->getFunctionParser()->setFunction($method)->parse()->getResult();
			foreach ($method->getParameters() as $parameter) {
				$result['methods'][$method->name]['parameters'] = [
					$parameter->getName() => $this->getParameterParser()->setParameter($parameter)->parse()->getResult()
				];
			}
		}
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param \ReflectionClass $reflection
	 * @param                  $result
	 */
	public function parseConstants(\ReflectionClass $reflection, &$result) {

		foreach ($reflection->getConstants() as $constantName => $constantValue) {
			$result['constants'][$constantName] = $this->getConstantParser()->setConstant([$constantName => $constantValue])->parse()->getResult();
		}
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $class
	 *
	 * @return $this
	 */
	public function setClass($class) {

		$this->class = $class;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return null
	 */
	public function getClass() {

		return $this->class;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param FunctionParser $functionParser
	 */
	public function setFunctionParser(FunctionParser $functionParser) {

		$this->functionParser = $functionParser;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return FunctionParser
	 */
	public function getFunctionParser() {

		return $this->functionParser;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param PropertyParser $propertyParser
	 *
	 * @return $this
	 */
	public function setPropertyParser(PropertyParser $propertyParser) {

		$this->propertyParser = $propertyParser;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return PropertyParser
	 */
	public function getPropertyParser() {

		return $this->propertyParser;
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
	 *
	 * @return mixed
	 */
	public function getResult() {

		return $this->result;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param ConstantParser $constantParser
	 *
	 * @return $this
	 */
	public function setConstantParser($constantParser) {

		$this->constantParser = $constantParser;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return ConstantParser
	 */
	public function getConstantParser() {

		return $this->constantParser;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param \Reflectionist\Reflection\Parser\ParameterParser $parameterParser
	 *
	 * @return $this
	 */
	public function setParameterParser($parameterParser) {

		$this->parameterParser = $parameterParser;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return \Reflectionist\Reflection\Parser\ParameterParser
	 */
	public function getParameterParser() {

		return $this->parameterParser;
	}
}
