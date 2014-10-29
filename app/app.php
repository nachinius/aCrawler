#!/usr/bin/env php
<?php

require_once './bootstrap.php';

// Create console application and add commands
use Symfony\Component\Console\Application;
use Nachinius\Command\GreetCommand;
use Nachinius\Command\LocationCommand;

$application = new Application();
$application->add(new GreetCommand());
$application->add(new LocationCommand());
$application->run();