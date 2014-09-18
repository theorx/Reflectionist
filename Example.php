<?php

namespace nigger {
	/**
	 * Class test
	 * @package nigger
	 */
	class test {

		/**
		 * @return string
		 */
		public function a() {

			return "b";
		}

	}
}
namespace IFACE {
	/**
	 * Interface Itest
	 * @package IFACE
	 */
	interface Itest {
		/**
		 * @param        $required
		 * @param null   $optional
		 * @param string $optional2
		 *
		 * @return mixed
		 */
		public function test($required, $optional = null, $optional2 = "myValue");
	}
}

namespace E {

	/**
	 * Class Example
	 * @package E
	 */
	class Example extends \nigger\test implements \IFACE\Itest {

		/**
		 *
		 */
		const TEST = 'neeger';

		/**
		 * @var
		 */
		private static $private_no_value;
		/**
		 * @var null
		 */
		private $private_with_value = null;
		/**
		 * @var array
		 */
		private static $private_with_value_arr = [1, 2, 3];
		/**
		 * @var
		 */
		public $public_no_value;
		/**
		 * @var null
		 */
		public $public_with_value = null;
		/**
		 * @var array
		 */
		public $public_with_value_arr = [1, 2, 3, 4, 5, 6];
		/**
		 * @var
		 */
		protected $protected_no_value;
		/**
		 * @var string
		 */
		protected $protected_with_value = "abcdefg";
		/**
		 * @var array
		 */
		protected $protected_with_value_arr = [2, 54, 8, 9];

		/**
		 * @param mixed $private_no_value
		 */
		public function setPrivateNoValue($private_no_value) {

			$this->private_no_value = $private_no_value;
		}

		/**
		 *
		 */
		 static function pubstatfun() {

		}

		/**
		 *
		 */
		private static function privstatfun() {

		}

		/**
		 *
		 */
		protected static function protstatfun() {

		}

		/**
		 * @return mixed
		 */
		public function getPrivateNoValue() {

			return $this->private_no_value;
		}

		/**
		 * @param null $private_with_value
		 */
		public function setPrivateWithValue($private_with_value) {

			$this->private_with_value = $private_with_value;
		}

		/**
		 * @return null
		 */
		public function getPrivateWithValue() {

			return $this->private_with_value;
		}

		/**
		 * @param array $private_with_value_arr
		 */
		public function setPrivateWithValueArr($private_with_value_arr) {

			$this->private_with_value_arr = $private_with_value_arr;
		}

		/**
		 * @return array
		 */
		public function getPrivateWithValueArr() {

			return $this->private_with_value_arr;
		}

		/**
		 * @param mixed $protected_no_value
		 */
		public function setProtectedNoValue($protected_no_value) {

			$this->protected_no_value = $protected_no_value;
		}

		/**
		 * @return mixed
		 */
		public function getProtectedNoValue() {

			return $this->protected_no_value;
		}

		/**
		 * @param string $protected_with_value
		 */
		public function setProtectedWithValue($protected_with_value) {

			$this->protected_with_value = $protected_with_value;
		}

		/**
		 * @return string
		 */
		public function getProtectedWithValue() {

			return $this->protected_with_value;
		}

		/**
		 * @param array $protected_with_value_arr
		 */
		public function setProtectedWithValueArr($protected_with_value_arr) {

			$this->protected_with_value_arr = $protected_with_value_arr;
		}

		/**
		 * @return array
		 */
		public function getProtectedWithValueArr() {

			return $this->protected_with_value_arr;
		}

		/**
		 * @param mixed $public_no_value
		 */
		public function setPublicNoValue($public_no_value) {

			$this->public_no_value = $public_no_value;
		}

		/**
		 * @return mixed
		 */
		public function getPublicNoValue() {

			return $this->public_no_value;
		}

		/**
		 * @param null $public_with_value
		 */
		public function setPublicWithValue($public_with_value) {

			$this->public_with_value = $public_with_value;
		}

		/**
		 * @return null
		 */
		public function getPublicWithValue() {

			return $this->public_with_value;
		}

		/**
		 * @param array $public_with_value_arr
		 */
		public function setPublicWithValueArr($public_with_value_arr) {

			$this->public_with_value_arr = $public_with_value_arr;
		}

		/**
		 * @return array
		 */
		public function getPublicWithValueArr() {

			return $this->public_with_value_arr;
		}

		/**
		 *
		 */
		public function __construct() {

		}

		/**
		 * @param        $required
		 * @param null   $optional
		 * @param string $optional2
		 *
		 * @return int
		 */
		public function test($required, $optional = null, $optional2 = "myValue") {

			static $noob = 4;

			return 1;
		}

		/**
		 * @return string
		 */
		private function nigger() {

			return "";
		}

		/**
		 * @param \PDO $test
		 *
		 * @return int
		 */
		private function nigger2(\PDO $test) {

			return 5;
		}


		/**
		 *
		 */
		protected function myProtected() {

		}
	}
}