<?php

include(__DIR__ . '/vendor/autoload.php');
include(__DIR__ . '/Example.php');

$analyzer = new Reflectionist\Analyzer();

$analyzer->addClass("E\\Example");
$analyzer->addClass("nigger\\test");


$analyzer->analyze();

print_r($analyzer->getResult());

