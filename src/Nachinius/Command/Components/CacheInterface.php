<?php

namespace Nachinius\Command\Components;

/**
 * Minimal conditions a cache must fullfil
 * 
 * @author ignacio
 *
 */
interface CacheInterface {
    
    /**
     * Set the content of the cache $key to $content
     * 
     * @param string $key
     * @param string $content
     * @return void
     */
    public function set($key, $content);
    
    /**
     * @param string $key
     * @return string of the Cache for $key if exists. False otherwise.
     */
    public function get($key);
    
    /**
     * Flush all the cache
     */
    public function flush();
}