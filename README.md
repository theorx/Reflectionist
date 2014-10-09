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
´´´


Usage
-----

```php
require(__DIR__.'/vendor/autoload.php');

$analyzer = new Reflectionist\Analyzer();

$result = $analyzer->addClass('vendor\ns\subns\class')->analyze()->getResults();
´´´

