<?php


namespace Reflectionist\Reflection\Parser;

/**
 * Class FunctionParser
 * @package Reflectionist\Reflection\Parser
 */
class FunctionParser extends AbstractParser {
	/**
	 * @var mixed
	 */
	private $result;
	/**
	 * @var \ReflectionMethod
	 */
	private $function;

	/**
	 * @return mixed|void
	 */
	public function parse() {

		echo "		Function [" . $this->getAccessType() . "]" . "[" . $this->getFunction()->getName() . "]" . PHP_EOL;


		/*
		$result['methods'][$method->name] = [
			'reflection'                 => $method,
			'name'                       => $method->name,
			'arguments'                  => $method->getParameters(),
			'docBlock'                   => $method->getDocComment(),
			'numberOfParameters'         => $method->getNumberOfParameters(),
			'numberOfRequiredParameters' => $method->getNumberOfRequiredParameters(),
			'methodStaticVariables'      => $method->getStaticVariables()
		];
		*/


		// TODO: Implement parse() method.

		$this->setResult($this->getFunction());

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAccessType() {

		$type = [];
		if ($this->getFunction()->isPrivate()) {
			$type[] = 'private';
		}
		if ($this->getFunction()->isPublic()) {
			$type[] = 'public';
		}
		if ($this->getFunction()->isProtected()) {
			$type[] = 'protected';
		}
		if ($this->getFunction()->isStatic()) {
			$type[] = 'static';
		}

		return implode(' ', $type);
	}

	/**
	 * @param \ReflectionMethod $function
	 *
	 * @return $this
	 */
	public function setFunction($function) {

		$this->function = $function;

		return $this;
	}

	/**
	 * @return \ReflectionMethod
	 */
	public function getFunction() {

		return $this->function;
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