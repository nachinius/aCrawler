<?php

require_once 'vendor/autoload.php';

// load src/* when followed PSR-0
use Symfony\Component\ClassLoader\ClassLoader;
$loader = new ClassLoader();
$loader->setUseIncludePath(false);
$loader->addPrefix('Nachinius', __DIR__.'/../src');
$loader->register();
