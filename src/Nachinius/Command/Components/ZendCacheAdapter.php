<?php
namespace Nachinius\Command\Components;

use Nachinius\Command\Components\CacheInterface;
use Zend\Cache\Storage\FlushableInterface;
use Zend\Cache\Storage\StorageInterface;
/**
 * Adapt a ZendCache into this system
 */
class ZendCacheAdapter implements CacheInterface, FlushableInterface
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
    
    public function flush() {
        if($this->cache instanceOf FlushableInterface) {
            $this->cache->flush();
        }
    }
}
