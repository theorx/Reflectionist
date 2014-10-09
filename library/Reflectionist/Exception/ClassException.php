<?php
namespace Reflectionist\Exception;

/**
 * Class ClassException
 *
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 *
 * @package Reflectionist\Exception
 */
class ClassException extends \Exception {

	/**
	 * Exception message that will be thrown.
	 *
	 * @var string
	 */
	protected $message = 'Class was not found';

	/**
	 * @var int
	 */
	protected $code = 1001;

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param string $class
	 */
	public function __construct($class) {

		$this->setMessage(sprintf('Class %s was not found.', $class));
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $message
	 *
	 * @return $this
	 */
	public function setMessage($message) {

		$this->message = $message;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $code
	 *
	 * @return $this
	 */
	public function setCode($code) {

		$this->code = $code;

		return $this;
	}
}
