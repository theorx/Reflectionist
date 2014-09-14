<?php

include(__DIR__ . '/vendor/autoload.php');

include(__DIR__ . '/Example.php');

$analyzer = new Reflectionist\Analyzer();

$analyzer->addClass("E\\Example");

$analyzer->analyze();



/*
$ref = new ReflectionClass("E\\Example");

print_r($ref);

//get all methods

print_r($ref->getConstants());
foreach ($ref->getProperties() as $property) {
	echo $property->getValue();
}
print_r($ref->getInterfaces());

foreach ($ref->getMethods() as $method) {
	print_r($method);
	echo $method->getDocComment() . "\n";
	echo $method->class . "\n";
	echo $method->getModifiers();
}
*/
//get all defaultProperties
//get property accessor
//get property docblock and parse it
//get property default value


//get all methods
//get method docblock and parse it
//get method accessor
//get method arguments
//get argument default value and typehint