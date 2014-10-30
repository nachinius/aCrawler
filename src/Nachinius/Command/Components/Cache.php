<?php

namespace Nachinius\Command\Components;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Cache to the filesystem, one key per filename.
 * 
 * @author ignacio
 *
 */
class Cache {
    
    private $workspace = NULL;
    
    /**
     * 
     * @param string $dir
     */
    public function __construct($dir) {
        $this->workspace = $dir;
    }
    
    /**
     * Create the directory in which the cache
     * is going to be stored, if not present.
     */
    public function prepare() {
        if (file_exists($this->workspace) === false) {
            mkdir($this->workspace, 0700, true);
        }
    }
    
    /**
     * Transform the $key to a filename
     * 
     * @param string $key
     */
    public function keyToFilename($key) {
        
    }
    
    public function set($key, $content) {
    }
    
    public function get($key) {
    }
}