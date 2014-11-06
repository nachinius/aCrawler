<?php
namespace Nachinius\Command\Components;

use Nachinius\Command\Components\CacheInterface;

/**
 * Adapt a ZendCache into this system
 */
class ZendCacheAdapter implements CacheInterface
{

    public function __construct(\Zend\cache\storage\StorageInterface $zendCacheAdapter)
    {
        $this->cache = $zendCacheAdapter;
    }

    public function get($key)
    {
        return $this->cache->getItem($key);
    }

    public function set($key, $content)
    {
        $this->cache->setItem($key, $content);
    }
}