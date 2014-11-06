<?php
namespace Nachinius\Command\Components;

use Nachinius\Command\Components\CacheInterface;
use Zend\Cache\Storage\StorageInterface;
/**
 * Adapt a ZendCache into this system
 */
class ZendCacheAdapter implements CacheInterface
{
    /**
     * 
     * @var StorageInterface
     */
    private $cache;

    public function __construct(StorageInterface $zendCacheAdapter)
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
