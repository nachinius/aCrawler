<?php
namespace Nachinius\Command\Components;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Cache to the filesystem, one key per filename.
 *
 * @author ignacio
 *        
 */
class Cache
{

    /**
     * address inside filesystem to store cached data
     *
     * @var string
     */
    private $workspace = NULL;

    /**
     *
     * @var Filesystem
     */
    private $fs = NULL;

    /**
     *
     * @param string $dir            
     * @param Filesystem $fs            
     */
    public function __construct($dir, Filesystem $fs = NULL)
    {
        $this->workspace = rtrim($dir, '/');
        $this->fs = $fs;
    }

    /**
     * Create the directory in which the cache
     * is going to be stored, if not present.
     */
    public function prepare()
    {
        if ($this->fs->exists($this->workspace) === false) {
            $this->fs->mkdir($this->workspace, 0700);
        }
    }

    /**
     * Transform the $key to a filename
     *
     * @param string $key            
     */
    public function keyToFilename($key)
    {
        $parts = explode('/', $key);
        if (count($parts) > 1) {
            $last = array_pop($parts);
            $last = $last . '-';
        } else {
            $last = '';
        }
        return $last . md5($key);
    }

    public function getFullPath($key)
    {
        return $this->workspace . DIRECTORY_SEPARATOR . $this->keyToFilename($key);
    }

    public function set($key, $content)
    {
        $path = $this->getFullPath($key);
        file_put_contents($path, $content);
    }

    public function get($key)
    {
        $path = $this->getFullPath($key);
        if($this->fs->exists($path)) {
            return file_get_contents($path);
        } else {
            return NULL;
        }
    }
}