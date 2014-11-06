#!/usr/bin/env php
<?php
require_once __DIR__ . '/bootstrap.php';

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;

$isDebug = true;

$file = __DIR__ . '/../cache/container.php';
$containerConfigCache = new ConfigCache($file, $isDebug);

if (!$containerConfigCache->isFresh()) {
    echo 'Rebuilding resources'.PHP_EOL;
    $containerBuilder = new ContainerBuilder();
    $containerBuilder->setParameter('app.root_dir', __DIR__);
    $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__ . '/config'));
    $loader->load('services.yml');
    
    $containerBuilder->compile();
    
    $dumper = new PhpDumper($containerBuilder);
    $containerConfigCache->write($dumper->dump(array(
        'class' => 'CachedContainerBuilder'
    )), $containerBuilder->getResources());
}

require_once $file;
$container = new CachedContainerBuilder();
$container->get('app')->run();

