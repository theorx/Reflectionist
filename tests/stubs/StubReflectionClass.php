<?php

namespace Tests\Stubs;

/**
 * Class StubReflectionClass
 */
class StubReflectionClass {

	const TEST_CONSTANT = 'test value';

	/**
	 * @var string
	 */
	public $name;

	/**
	 * @var int
	 */
	public $age;

	/**
	 * @var float
	 */
	public $height;

	/**
	 * @var float
	 */
	public $weight;

	/**
	 * @return $this
	 */
	public function parser(Callable $callableParam, array $arrayParam, $simpleParam, $optionalParam = 'default value') {

		return $this;
	}
//
//	/**
//	 * @return bool
//	 */
//	public function export() {
//
//		return false;
//	}
//
//	/**
//	 * @return int
//	 */
//	public function build() {
//
//		return 1;
//	}
//
//	/**
//	 * @param int $age
//	 */
//	public function setAge($age) {
//
//		$this->age = $age;
//	}
//
//	/**
//	 * @return int
//	 */
//	public function getAge() {
//
//		return $this->age;
//	}
//
//	/**
//	 * @param float $height
//	 */
//	public function setHeight($height) {
//
//		$this->height = $height;
//	}
//
//	/**
//	 * @return float
//	 */
//	public function getHeight() {
//
//		return $this->height;
//	}
//
//	/**
//	 * @param string $name
//	 */
//	public function setName($name) {
//
//		$this->name = $name;
//	}
//
//	/**
//	 * @return string
//	 */
//	public function getName() {
//
//		return $this->name;
//	}
//
//	/**
//	 * @param float $weight
//	 */
//	public function setWeight($weight) {
//
//		$this->weight = $weight;
//	}
//
//	/**
//	 * @return float
//	 */
//	public function getWeight() {
//
//		return $this->weight;
//	}
}
