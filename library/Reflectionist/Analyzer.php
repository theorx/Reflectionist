<?php

namespace Reflectionist;

/**
 * Class Analyzer
 * @package Reflectionist
 */
class Analyzer {


	/**
	 * @var array
	 */
	private $classes = [];
	/**
	 * @var array
	 */
	private $objects = [];
	/**
	 * @var array
	 */
	private $files = [];
	/**
	 * @var null
	 */
	private $result = null;


	/**
	 * @var Reflection\Parser\ClassParser
	 */
	private $classParser = null;

	/**
	 *
	 */
	public function __construct() {

		$this->setClassParser(Factory\Factory::getClassParser());
	}

	/**
	 *
	 */
	public function analyze() {

		//gets class parser

		foreach ($this->getClasses() as $class) {
			$result   = [];
			$result[] = $this->getClassParser()->setClass($class)->parse()->getResult();
		}


		//gets all files
		//gets all classes
		//gets all objects
	}

	/**
	 * @param $filePath
	 */
	public function addFile($filePath) {

		//parse it to reflectionfile

	}

	/**
	 * @param array $filePaths
	 */
	public function addFiles(array $filePaths) {

		foreach ($filePaths as $filePath) {
			$this->addFile($filePath);
		}
	}

	/**
	 * @param $class
	 */
	public function addClass($class) {

		//add class
		$this->setClasses($this->getClasses() + [$class]);
	}

	/**
	 * @param array $classes
	 */
	public function addClasses(array $classes) {

		foreach ($classes as $class) {
			$this->addClass($class);
		}
	}

	/**
	 *
	 */
	public function addObject($object) {

	}

	/**
	 * @param array $objects
	 */
	public function addObjects(array $objects) {

		foreach ($objects as $object) {
			$this->addObject($object);
		}
	}

	/**
	 * @return Reflection\Parser\ClassParser
	 */
	public function getClassParser() {

		return $this->classParser;
	}

	/**
	 * @param $classParser
	 *
	 * @return $this
	 */
	public function setClassParser($classParser) {

		$this->classParser = $classParser;

		return $this;
	}

	/**
	 * @param array $classes
	 */
	public function setClasses($classes) {

		$this->classes = $classes;
	}

	/**
	 * @return array
	 */
	public function getClasses() {

		return $this->classes;
	}

	/**
	 * @param array $files
	 */
	public function setFiles($files) {

		$this->files = $files;
	}

	/**
	 * @return array
	 */
	public function getFiles() {

		return $this->files;
	}

	/**
	 * @param array $objects
	 */
	public function setObjects($objects) {

		$this->objects = $objects;
	}

	/**
	 * @return array
	 */
	public function getObjects() {

		return $this->objects;
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

