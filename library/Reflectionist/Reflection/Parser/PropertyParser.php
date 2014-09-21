<?php

namespace Reflectionist\Reflection\Parser;

use Reflectionist\Factory\Factory;

/**
 * Class PropertyParser
 *
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 * @package Reflectionist\Reflection\Parser
 */
class PropertyParser extends AbstractParser {

	/**
	 * @var mixed
	 */
	private $result;

	/**
	 * @var \ReflectionProperty
	 */
	private $property;

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 */
	public function __construct() {

	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return $this|void
	 */
	public function parse() {

		$this->setResult([
			'accessType' => $this->getAccessType(),
			'name'       => $this->getProperty()->getName(),
			'value'      => null,
			'phpdoc'     => Factory::getCommentBlock()->setPhpDoc($this->getProperty()->getDocComment())->parse()->getResult()

		]);

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return string
	 */
	public function getAccessType() {

		$type = [];
		if ($this->getProperty()->isPrivate()) {
			$type[] = 'private';
		}
		if ($this->getProperty()->isPublic()) {
			$type[] = 'public';
		}
		if ($this->getProperty()->isProtected()) {
			$type[] = 'protected';
		}
		if ($this->getProperty()->isStatic()) {
			$type[] = 'static';
		}

		return implode(' ', $type);
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param \ReflectionProperty $property
	 *
	 * @return $this
	 */
	public function setProperty($property) {

		$this->property = $property;

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 * @return \ReflectionProperty
	 */
	public function getProperty() {

		return $this->property;
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
