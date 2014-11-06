<?php

namespace Nachinius\Command\Components;

use Nachinius\Command\Components\CacheInterface;

/**
 * Obtains a text given an URI.
 * 
 * Obtains a text given an URI either from an external
 * resource or from a cache.
 * If not previously in cache, it fallbacks to an external
 * resource and then saves it into cache.
 * 
 * @author ignacio
 *
 */
class HtmlGetter {
    
    private $cache = NULL;
    
    /**
     * 
     * @var CacheInterface
     */
    private $getter = NULL;
    
    /**
     * 
     * @param HttpGetter $getter (must implement ->get($key))
     * @param CacheInterface $cache (optional) (must implement ->set($key, content) and ->get($key)
     */
    public function __construct($getter, CacheInterface $cache = NULL) {
        $this->getter = $getter;
        $this->cache = $cache;
    }
    
    /**
     * Set cache $key to have $content
     * 
     * @param string $key key to assign
     * @param string $content content to store
     */
    public function setCache($key, $content) {
        if(!empty($this->cache)) {
            $this->cache->set($key, $content);
        }
    }
    
    /**
     * Obtain cache identified by $key
     * 
     * @param string $key
     */
    public function getCache($key) {
        if(empty($this->cache)) {
            return '';
        }
        
        try {
            return $this->cache->get($key);
        } catch (\Exception $e) {
            return '';
        }
        
    }
    
    /**
     * Obtain content of $url.
     * 
     * Try to use cache or fallback to getter
     * 
     * @param string $url
     * @return string 
     */
    public function execute($url) {
        $content = $this->getCache($url);
        if(empty($content)) {
            $content = $this->getter->get($url);
        }
        $this->setCache($url, $content);
        return $content;
    }
}