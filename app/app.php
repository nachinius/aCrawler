#!/usr/bin/env php
<?php
require_once __DIR__ . '/bootstrap.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

// Using container to configure

$container = new ContainerBuilder();

// cache
$container->register('fs', 'Symfony\\Component\\Filesystem\\Filesystem');
$container->register('cache', 'Nachinius\\Command\\Components\\Cache')
    ->addArgument(__DIR__ . '/../data')
    ->addArgument(new Reference('fs'));

// Commands as services
$container->register('LocationCommand', 'Nachinius\\Command\\LocationCommand')->addArgument(new Reference('cache'));

// app as service
$container->register('app','Symfony\\Component\\Console\\Application')
// register the command in the app
->addMethodCall('add',array(new Reference('LocationCommand')));

$application = $container->get('app')->run();
