#!/usr/bin/env php
<?php
require_once __DIR__ . '/bootstrap.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

// Using container to configure

$container = new ContainerBuilder();
$container->setParameter('app.root_dir', __DIR__);
$loader = new YamlFileLoader($container, new FileLocator(__DIR__ . '/config'));
$loader->load('services.yml');

$application = $container->get('app')->run();
