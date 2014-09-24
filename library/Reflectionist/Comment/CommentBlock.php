<?php

namespace Reflectionist\Comment;

/**
 * Class CommentBlock
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 *
 * @package Reflectionist\Comment
 */
class CommentBlock {

	/**
	 * @var string
	 */
	private $phpDoc;

	/**
	 * @var mixed
	 */
	private $result;

	/**
	 * This function parses phpdoc, first formats the raw input to usable format
	 * and then fetches all the @tags from the comment, after that
	 * gets short and long description
	 *
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 */
	public function parse() {

		$result           = [];
		$tags             = [];
		$shortDescription = null;
		$longDescription  = null;
		$phpDoc           = explode(PHP_EOL, str_replace(['/**', '/*', '*/', '*', '//', '#'], '', $this->getPhpDoc()));
		//Trim all the rows
		$this->trimPhpDoc($phpDoc);
		//Fetch tags from docblock
		$this->fetchTagsFromPhpDoc($phpDoc, $tags);
		//Fetch short and long description
		$this->fetchDescriptions($phpDoc, $shortDescription, $longDescription);
		//Set descriptions and tags as result
		$result['shortDescription'] = $shortDescription;
		$result['longDescription']  = $longDescription;
		$result['tags']             = $tags;

		$this->setResult($result);

		return $this;
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $phpDoc
	 */
	public function trimPhpDoc(&$phpDoc) {

		//Trim all the rows
		foreach ($phpDoc as $key => $value) {
			$phpDoc[$key] = ltrim(trim($value));
		}
	}

	/**
	 * FetchTagsFromPhpDoc
	 *
	 * This function retrieves docblock tags from phpdoc.
	 * These tags are set to $tags variable as nested array.
	 *
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $phpDoc
	 * @param $tags
	 */
	public function fetchTagsFromPhpDoc(&$phpDoc, &$tags) {

		//Fetch tags from docblock
		foreach ($phpDoc as $key => $value) {
			if (strlen($value) > 0 && $value[0] == '@') {
				$parts = explode(' ', $value);
				$tag   = $parts[0];
				unset($parts[0], $phpDoc[$key]);
				$tags[$tag][] = ltrim(rtrim(implode(' ', $parts)));
			}
		}
	}

	/**
	 * FetchDescriptions fetches short and long description from docblock
	 *
	 * This function is used for parsing phpdoc comment. It retrieves short description
	 * and long description from the docblock and sets them to $shortDescription and $longDescription
	 * variables.
	 *
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $phpDoc
	 * @param $shortDescription
	 * @param $longDescription
	 */
	public function fetchDescriptions(&$phpDoc, &$shortDescription, &$longDescription) {

		//Fetch short and long description
		$keys = array_keys($phpDoc);
		for ($i = 0; $i < count($keys); $i++) {
			$next     = (isset($keys[$i + 1]) ? $phpDoc[$keys[$i + 1]] : null);
			$current  = (isset($keys[$i]) ? $phpDoc[$keys[$i]] : null);
			$previous = (isset($keys[$i - 1]) ? $phpDoc[$keys[$i - 1]] : null);

			if (strlen($shortDescription) == 0 && strlen($next) == 0 && strlen($previous) == 0 && strlen($current) > 0) {
				$shortDescription = $current;
			} else {
				if (strlen($current) > 0) {
					$longDescription .= $current . PHP_EOL;
				}
			}

		}
	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $phpDoc
	 *
	 * @return $this
	 */
	public function setPhpDoc($phpDoc) {

		$this->phpDoc = $phpDoc;

		return $this;

	}

	/**
	 * @author Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return mixed
	 */
	public function getPhpDoc() {

		return $this->phpDoc;
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
	 *
	 * @return mixed
	 */
	public function getResult() {

		return $this->result;
	}
}
