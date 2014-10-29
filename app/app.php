#!/usr/bin/env php
<?php

require_once 'vendor/autoload.php';

// load src/* when followed PSR-0
use Symfony\Component\ClassLoader\ClassLoader;
$loader = new ClassLoader();
$loader->setUseIncludePath(false);
$loader->addPrefix('Nachinius', __DIR__.'/../src');
$loader->register();

// Create console application and add commands
use Symfony\Component\Console\Application;
use Nachinius\Command\GreetCommand;
use Nachinius\Command\LocationCommand;

$application = new Application();
$application->add(new GreetCommand());
$application->add(new LocationCommand());
$application->run();