<?php
namespace Reflectionist\Reflection\Parser;

use Reflectionist\Factory\Factory;

/**
 * Class FunctionParser
 *
 * Usage:
 * $functionParser->setFunction($reflectionFunction)->parse()->getResult();
 * This returns the parsed result of reflectionMethod
 *
 * @author  Lauri Orgla <TheOrX@hotmail.com>
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
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return mixed|void
	 */
	public function parse() {

		$this->setResult(
			 [
				 'accessType'                 => $this->getAccessType(),
				 'name'                       => $this->getFunction()->name,
				 'parameters'                 => $this->getFunction()->getParameters(),
				 'numberOfParameters'         => $this->getFunction()->getNumberOfParameters(),
				 'numberOfRequiredParameters' => $this->getFunction()->getNumberOfRequiredParameters(),
				 'methodStaticVariables'      => $this->getFunction()->getStaticVariables(),
				 'phpdoc'                     => Factory::getCommentBlock()->setPhpDoc($this->getFunction()->getDocComment())->parse()->getResult()
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
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param \ReflectionMethod $function
	 *
	 * @return $this
	 */
	public function setFunction($function) {

		$this->function = $function;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return \ReflectionMethod
	 */
	public function getFunction() {

		return $this->function;
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
