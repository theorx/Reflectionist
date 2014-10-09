<?php
namespace Reflectionist\Reflection\Parser;

use Reflectionist\Exception\ClassException;
use Reflectionist\Factory\Factory;

/**
 * Class ClassParser
 *
 * ClassParser class is used for processing given class
 * This class calls all the sub classes for parsing internal components
 * of the class being parsed.
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
	 * @var MethodParser
	 */
	private $methodParser = null;

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
	 * @param MethodParser    $functionParser
	 * @param PropertyParser  $propertyParser
	 * @param ConstantParser  $constantParser
	 * @param ParameterParser $parameterParser
	 */
	public function __construct(
		MethodParser $functionParser,
		PropertyParser $propertyParser,
		ConstantParser $constantParser,
		ParameterParser $parameterParser
	) {

		$this->setMethodParser($functionParser);
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
		if (!class_exists($this->getClass(), true) && !is_object($this->getClass())) {
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

		$result['properties'] = [];
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

		$result['methods'] = [];
		foreach ($reflection->getMethods() as $method) {
			$result['methods'][$method->name] = $this->getMethodParser()->setMethod($method)->parse()->getResult();
			$this->parseMethodParameters($method, $result);
		}
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param \ReflectionMethod $method
	 * @param                   $result
	 */
	public function parseMethodParameters(\ReflectionMethod $method, &$result) {

		$result['methods'][$method->getName()]['parameters'] = [];
		foreach ($method->getParameters() as $parameter) {
			$result['methods'][$method->getName()]['parameters'][$parameter->getName()]
				= $this->getParameterParser()->setParameter($parameter)->parse()->getResult();
		}
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param \ReflectionClass $reflection
	 * @param                  $result
	 */
	public function parseConstants(\ReflectionClass $reflection, &$result) {

		$result['constants'] = [];
		foreach ($reflection->getConstants() as $constantName => $constantValue) {
			$result['constants'][$constantName] =
				$this->getConstantParser()->setConstant([$constantName => $constantValue])->parse()->getResult();
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
	 * @param MethodParser $methodParser
	 */
	public function setMethodParser(MethodParser $methodParser) {

		$this->methodParser = $methodParser;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return MethodParser
	 */
	public function getMethodParser() {

		return $this->methodParser;
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
