<?php
namespace Reflectionist\Reflection\Parser;

use Reflectionist\Factory\Factory;

/**
 * Class MethodParser
 *
 * Usage:
 * $methodParser->setMethod($reflectionFunction)->parse()->getResult();
 * This returns the parsed result of reflectionMethod
 *
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 * @package Reflectionist\Reflection\Parser
 */
class MethodParser extends AbstractParser {

	/**
	 * @var mixed
	 */
	private $result;

	/**
	 * @var \ReflectionMethod
	 */

	private $method;

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return mixed|void
	 */
	public function parse() {

		$this->setResult(
			 [
				 'accessType'                 => $this->getAccessType(),
				 'name'                       => $this->getMethod()->name,
				 'parameters'                 => $this->getMethod()->getParameters(),
				 'numberOfParameters'         => $this->getMethod()->getNumberOfParameters(),
				 'numberOfRequiredParameters' => $this->getMethod()->getNumberOfRequiredParameters(),
				 'methodStaticVariables'      => $this->getMethod()->getStaticVariables(),
				 'phpdoc'                     => Factory::getCommentBlock()->setPhpDoc($this->getMethod()->getDocComment())->parse()->getResult()
			 ]);

		return $this;
	}

	/**
	 * Returns the accessType of current function
	 *
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return string
	 */
	public function getAccessType() {

		$type = [];
		if ($this->getMethod()->isPrivate()) {
			$type[] = 'private';
		}
		if ($this->getMethod()->isPublic()) {
			$type[] = 'public';
		}
		if ($this->getMethod()->isProtected()) {
			$type[] = 'protected';
		}
		if ($this->getMethod()->isStatic()) {
			$type[] = 'static';
		}

		return implode(' ', $type);
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param \ReflectionMethod $method
	 *
	 * @return $this
	 */
	public function setMethod($method) {

		$this->method = $method;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return \ReflectionMethod
	 */
	public function getMethod() {

		return $this->method;
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
	 * @return mixed
	 */
	public function getResult() {

		return $this->result;
	}
}
