<?php

namespace Reflectionist;

/**
 * Class Analyzer
 *
 * Analyzer class can be used for getting reflectionist's results for given class(es)
 * Usage example: $result = $analyzer->addClass("NameOfMyClass")->analyze()->getResults();
 * In $result variable will be all the data about given class(es).
 *
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 *
 * @package Reflectionist
 */
class Analyzer {

	/**
	 * @var array
	 */
	private $classes = [];

	/**
	 * @var mixed
	 */
	private $result = null;

	/**
	 * @var Reflection\Parser\ClassParser
	 */
	private $classParser = null;

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 */
	public function __construct() {

		$this->setClassParser(Factory\Factory::getClassParser());
	}

	/**
	 * analyze
	 * This function is used for parsing all the classes.
	 * Parsing results will be set to result variable and after parsing
	 * you can call function getResult() to get the analyzer results.
	 *
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return $this
	 */
	public function analyze() {

		$result = [];
		foreach ($this->getClasses() as $class) {
			$result[$class] = $this->getClassParser()->setClass($class)->parse()->getResult();
		}

		$this->setResult($result);

		return $this;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $class
	 *
	 * @return $this
	 */
	public function addClass($class) {

		$this->setClasses($this->getClasses() + [$class]);

		return $this;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param array $classes
	 *
	 * @return $this
	 */
	public function addClasses(array $classes) {

		foreach ($classes as $class) {
			$this->addClass($class);
		}

		return $this;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 * @return Reflection\Parser\ClassParser
	 */
	public function getClassParser() {

		return $this->classParser;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $classParser
	 *
	 * @return $this
	 */
	public function setClassParser($classParser) {

		$this->classParser = $classParser;

		return $this;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param array $classes
	 *
	 * @return $this
	 */
	public function setClasses($classes) {

		$this->classes = $classes;

		return $this;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 * @return array
	 */
	public function getClasses() {

		return $this->classes;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
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
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 * @return mixed
	 */
	public function getResult() {

		return $this->result;
	}
}
