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
    public function __construct($dir, Filesystem $fs = NULL) {
        $this->workspace = $dir;
        if(empty($fs)) {
            $fs = new Filesystem();
        }
        $this->fs = $fs;
    }
    
    /**
     * Create the directory in which the cache
     * is going to be stored, if not present.
     */
    public function prepare() {
        if ($this->fs->exists($this->workspace) === false) {
            $this->fs->mkdir($this->workspace, 0700);
        }
    }
    
    /**
     * Transform the $key to a filename
     * 
     * @param string $key
     */
    public function keyToFilename($key) {
        $parts = split('/', $key);
        if(count($parts)>1) {
            $last = array_pop($parts);
            $last = $last.'-';
        } else {
            $last = '';
        }
        return $last.md5($key);
    }
    
    public function set($key, $content) {
        
    }
    
    public function get($key) {
    }
}