#!/usr/bin/env php
<?php

require_once __DIR__.'/bootstrap.php';

// Create console application and add commands
use Symfony\Component\Console\Application;
use Nachinius\Command\GreetCommand;
use Nachinius\Command\LocationCommand;
use Nachinius\Command\Components\Cache;
use Symfony\Component\Filesystem\Filesystem;

$fs = new Filesystem();
$cache = new Cache(__DIR__.'/../data', $fs);

$application = new Application();
$application->add(new GreetCommand());
$application->add(new LocationCommand($cache));
$application->run();