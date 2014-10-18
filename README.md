## Reflectionist ##

#Author#
--------

- Lauri Orgla

#Requirements#
------------

Reflectionist requires PHP 5.5 ( other versions not tested yet ) with Reflection module.


Installation
------------

```sh
$ git clone https://github.com/theorx/Reflectionist.git

$ ./composer.phar update

$ ./composer.phar dump-autoload -o
```


Usage
-----

```php
require(__DIR__.'/vendor/autoload.php');

$analyzer = new Reflectionist\Analyzer();

$result = $analyzer->addClass('vendor\ns\subns\class')->analyze()->getResults();
```

Example input
-------------

```php
<?php

namespace Reflectionist;

	/**
	 * TODO: Add method for reading classes from files. But the namespace would also have to be correct after reading
	 */

/**
 * Class Analyzer
 *
 * Analyzer class can be used for getting reflectionist's results for given class(es)
 * Usage example: $result = $analyzer->addClass("NameOfMyClass")->analyze()->getResults();
 * In $result variable will be all the data about given class(es).
 *
 * @author  Lauri Orgla <TheOrX@hotmail.com>
 *
 * @package Reflectionist
 */
class Analyzer {

	/**
	 * Holds an array of classes that are added for analyzing.
	 * @var array
	 */
	private $classes = [];

	/**
	 * Holds and array of results after analyze() method has been called.
	 *
	 * @var mixed
	 */
	private $result = null;

	/**
	 * @var Reflection\Parser\ClassParser
	 */
	private $classParser = null;

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 */
	public function __construct() {

		$this->setClassParser(Factory\Factory::getClassParser());
	}

	/**
	 * analyze
	 * This function is used for parsing all the classes.
	 * Parsing results will be set to result variable and after parsing
	 * you can call function getResult() to get the analyzer results.
	 *
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return $this
	 */
	public function analyze() {

		$result = [];
		foreach ($this->getClasses() as $class) {
			$result[$class] = $this->getClassParser()->setClass($class)->parse()->getResult();
		}

		$this->setResult($result);

		return $this;
	}

	/**
	 * addClass adds class to local list of classes.
	 *
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $class
	 *
	 * @return $this
	 */
	public function addClass($class) {

		$this->setClasses(array_merge($this->getClasses(), [$class]));

		return $this;
	}

	/**
	 * addClasses adds multiple classes from input $classes to local list of classes.
	 *
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param array $classes
	 *
	 * @return $this
	 */
	public function addClasses(array $classes) {

		foreach ($classes as $class) {
			$this->addClass($class);
		}

		return $this;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @return Reflection\Parser\ClassParser
	 */
	public function getClassParser() {

		return $this->classParser;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param $classParser
	 *
	 * @return $this
	 */
	public function setClassParser($classParser) {

		$this->classParser = $classParser;

		return $this;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 *
	 * @param array $classes
	 *
	 * @return $this
	 */
	public function setClasses($classes) {

		$this->classes = $classes;

		return $this;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 * @return array
	 */
	public function getClasses() {

		return $this->classes;
	}

	/**
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
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
	 * @author  Lauri Orgla <TheOrX@hotmail.com>
	 * @return mixed
	 */
	public function getResult() {

		return $this->result;
	}
}
```

Example output
--------------

```php

Array
(
    [Reflectionist\Analyzer] => Array
        (
            [phpdoc] => Array
                (
                    [shortDescription] => Class Analyzer
                    [longDescription] => Analyzer class can be used for getting reflectionist's results for given class(es)
Usage example: $result = $analyzer->addClass("NameOfMyClass")->analyze()->getResults();
In $result variable will be all the data about given class(es).

                    [tags] => Array
                        (
                            [@author] => Array
                                (
                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                )

                            [@package] => Array
                                (
                                    [0] => Reflectionist
                                )

                        )

                )

            [class] => Array
                (
                    [name] => Reflectionist\Analyzer
                    [phpdoc] => Array
                        (
                            [shortDescription] => Class Analyzer
                            [longDescription] => Analyzer class can be used for getting reflectionist's results for given class(es)
Usage example: $result = $analyzer->addClass("NameOfMyClass")->analyze()->getResults();
In $result variable will be all the data about given class(es).

                            [tags] => Array
                                (
                                    [@author] => Array
                                        (
                                            [0] => Lauri Orgla <TheOrX@hotmail.com>
                                        )

                                    [@package] => Array
                                        (
                                            [0] => Reflectionist
                                        )

                                )

                        )

                )

            [constants] => Array
                (
                )

            [properties] => Array
                (
                    [classes] => Array
                        (
                            [accessType] => private
                            [name] => classes
                            [value] =>
                            [phpdoc] => Array
                                (
                                    [shortDescription] => Holds an array of classes that are added for analyzing.
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@var] => Array
                                                (
                                                    [0] => array
                                                )

                                        )

                                )

                            [defaultValue] => Array
                                (
                                )

                        )

                    [result] => Array
                        (
                            [accessType] => private
                            [name] => result
                            [value] =>
                            [phpdoc] => Array
                                (
                                    [shortDescription] => Holds and array of results after analyze() method has been called.
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@var] => Array
                                                (
                                                    [0] => mixed
                                                )

                                        )

                                )

                            [defaultValue] =>
                        )

                    [classParser] => Array
                        (
                            [accessType] => private
                            [name] => classParser
                            [value] =>
                            [phpdoc] => Array
                                (
                                    [shortDescription] =>
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@var] => Array
                                                (
                                                    [0] => Reflection\Parser\ClassParser
                                                )

                                        )

                                )

                            [defaultValue] =>
                        )

                )

            [methods] => Array
                (
                    [__construct] => Array
                        (
                            [accessType] => public
                            [name] => __construct
                            [parameters] => Array
                                (
                                )

                            [numberOfParameters] => 0
                            [numberOfRequiredParameters] => 0
                            [methodStaticVariables] => Array
                                (
                                )

                            [phpdoc] => Array
                                (
                                    [shortDescription] =>
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@author] => Array
                                                (
                                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                                )

                                        )

                                )

                        )

                    [analyze] => Array
                        (
                            [accessType] => public
                            [name] => analyze
                            [parameters] => Array
                                (
                                )

                            [numberOfParameters] => 0
                            [numberOfRequiredParameters] => 0
                            [methodStaticVariables] => Array
                                (
                                )

                            [phpdoc] => Array
                                (
                                    [shortDescription] =>
                                    [longDescription] => analyze
This function is used for parsing all the classes.
Parsing results will be set to result variable and after parsing
you can call function getResult() to get the analyzer results.

                                    [tags] => Array
                                        (
                                            [@author] => Array
                                                (
                                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                                )

                                            [@return] => Array
                                                (
                                                    [0] => $this
                                                )

                                        )

                                )

                        )

                    [addClass] => Array
                        (
                            [accessType] => public
                            [name] => addClass
                            [parameters] => Array
                                (
                                    [class] => Array
                                        (
                                            [name] => class
                                            [type] =>
                                            [isOptional] =>
                                            [position] => 0
                                            [defaultValue] =>
                                        )

                                )

                            [numberOfParameters] => 1
                            [numberOfRequiredParameters] => 1
                            [methodStaticVariables] => Array
                                (
                                )

                            [phpdoc] => Array
                                (
                                    [shortDescription] => addClass adds class to local list of classes.
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@author] => Array
                                                (
                                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                                )

                                            [@param] => Array
                                                (
                                                    [0] => $class
                                                )

                                            [@return] => Array
                                                (
                                                    [0] => $this
                                                )

                                        )

                                )

                        )

                    [addClasses] => Array
                        (
                            [accessType] => public
                            [name] => addClasses
                            [parameters] => Array
                                (
                                    [classes] => Array
                                        (
                                            [name] => classes
                                            [type] => Array
                                            [isOptional] =>
                                            [position] => 0
                                            [defaultValue] =>
                                        )

                                )

                            [numberOfParameters] => 1
                            [numberOfRequiredParameters] => 1
                            [methodStaticVariables] => Array
                                (
                                )

                            [phpdoc] => Array
                                (
                                    [shortDescription] => addClasses adds multiple classes from input $classes to local list of classes.
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@author] => Array
                                                (
                                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                                )

                                            [@param] => Array
                                                (
                                                    [0] => array $classes
                                                )

                                            [@return] => Array
                                                (
                                                    [0] => $this
                                                )

                                        )

                                )

                        )

                    [getClassParser] => Array
                        (
                            [accessType] => public
                            [name] => getClassParser
                            [parameters] => Array
                                (
                                )

                            [numberOfParameters] => 0
                            [numberOfRequiredParameters] => 0
                            [methodStaticVariables] => Array
                                (
                                )

                            [phpdoc] => Array
                                (
                                    [shortDescription] =>
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@author] => Array
                                                (
                                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                                )

                                            [@return] => Array
                                                (
                                                    [0] => Reflection\Parser\ClassParser
                                                )

                                        )

                                )

                        )

                    [setClassParser] => Array
                        (
                            [accessType] => public
                            [name] => setClassParser
                            [parameters] => Array
                                (
                                    [classParser] => Array
                                        (
                                            [name] => classParser
                                            [type] =>
                                            [isOptional] =>
                                            [position] => 0
                                            [defaultValue] =>
                                        )

                                )

                            [numberOfParameters] => 1
                            [numberOfRequiredParameters] => 1
                            [methodStaticVariables] => Array
                                (
                                )

                            [phpdoc] => Array
                                (
                                    [shortDescription] =>
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@author] => Array
                                                (
                                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                                )

                                            [@param] => Array
                                                (
                                                    [0] => $classParser
                                                )

                                            [@return] => Array
                                                (
                                                    [0] => $this
                                                )

                                        )

                                )

                        )

                    [setClasses] => Array
                        (
                            [accessType] => public
                            [name] => setClasses
                            [parameters] => Array
                                (
                                    [classes] => Array
                                        (
                                            [name] => classes
                                            [type] =>
                                            [isOptional] =>
                                            [position] => 0
                                            [defaultValue] =>
                                        )

                                )

                            [numberOfParameters] => 1
                            [numberOfRequiredParameters] => 1
                            [methodStaticVariables] => Array
                                (
                                )

                            [phpdoc] => Array
                                (
                                    [shortDescription] =>
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@author] => Array
                                                (
                                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                                )

                                            [@param] => Array
                                                (
                                                    [0] => array $classes
                                                )

                                            [@return] => Array
                                                (
                                                    [0] => $this
                                                )

                                        )

                                )

                        )

                    [getClasses] => Array
                        (
                            [accessType] => public
                            [name] => getClasses
                            [parameters] => Array
                                (
                                )

                            [numberOfParameters] => 0
                            [numberOfRequiredParameters] => 0
                            [methodStaticVariables] => Array
                                (
                                )

                            [phpdoc] => Array
                                (
                                    [shortDescription] =>
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@author] => Array
                                                (
                                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                                )

                                            [@return] => Array
                                                (
                                                    [0] => array
                                                )

                                        )

                                )

                        )

                    [setResult] => Array
                        (
                            [accessType] => public
                            [name] => setResult
                            [parameters] => Array
                                (
                                    [result] => Array
                                        (
                                            [name] => result
                                            [type] =>
                                            [isOptional] =>
                                            [position] => 0
                                            [defaultValue] =>
                                        )

                                )

                            [numberOfParameters] => 1
                            [numberOfRequiredParameters] => 1
                            [methodStaticVariables] => Array
                                (
                                )

                            [phpdoc] => Array
                                (
                                    [shortDescription] =>
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@author] => Array
                                                (
                                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                                )

                                            [@param] => Array
                                                (
                                                    [0] => mixed $result
                                                )

                                            [@return] => Array
                                                (
                                                    [0] => $this
                                                )

                                        )

                                )

                        )

                    [getResult] => Array
                        (
                            [accessType] => public
                            [name] => getResult
                            [parameters] => Array
                                (
                                )

                            [numberOfParameters] => 0
                            [numberOfRequiredParameters] => 0
                            [methodStaticVariables] => Array
                                (
                                )

                            [phpdoc] => Array
                                (
                                    [shortDescription] =>
                                    [longDescription] =>
                                    [tags] => Array
                                        (
                                            [@author] => Array
                                                (
                                                    [0] => Lauri Orgla <TheOrX@hotmail.com>
                                                )

                                            [@return] => Array
                                                (
                                                    [0] => mixed
                                                )

                                        )

                                )

                        )

                )

        )

)

```