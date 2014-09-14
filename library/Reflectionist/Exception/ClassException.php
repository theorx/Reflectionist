<?php


namespace Reflectionist\Exception;

/**
 * Class ClassException
 * @package Reflectionist\Exception
 */
class ClassException extends \Exception {

	/**
	 * @var string
	 */
	protected $message = 'Class was not found';
	/**
	 * @var int
	 */
	protected $code = 1001;

	/**
	 * @param string $class
	 */
	public function __construct($class) {

		$this->setMessage(sprintf('Class %s was not found.', $class));
	}

	/**
	 * @param $message
	 *
	 * @return $this
	 */
	public function setMessage($message) {

		$this->message = $message;

		return $this;
	}

	/**
	 * @param $code
	 *
	 * @return $this
	 */
	public function setCode($code) {

		$this->code = $code;

		return $this;
	}
}