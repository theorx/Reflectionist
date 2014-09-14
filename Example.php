<?php

namespace nigger {
	class test {

		public function a() {

			return "b";
		}

	}
}
namespace IFACE {
	interface Itest {
		public function test($required, $optional = null, $optional2 = "myValue");
	}
}

namespace E {

	class Example extends \nigger\test implements \IFACE\Itest {

		const TEST = 'neeger';

		private $private_no_value;
		private $private_with_value = null;
		private $private_with_value_arr = [1, 2, 3];
		public $public_no_value;
		public $public_with_value = null;
		public $public_with_value_arr = [1, 2, 3, 4, 5, 6];
		protected $protected_no_value;
		protected $protected_with_value = "abcdefg";
		protected $protected_with_value_arr = [2, 54, 8, 9];

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

			return 1;
		}

		private function nigger() {

			return "";
		}

		private function nigger2(PDO $test) {

			return 5;
		}


		protected function myProtected() {

		}
	}
}