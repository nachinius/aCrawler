<?php
use \PHPUnit_Framework_TestCase;
use Nachinius\Command\Components\Cache;
use org\bovigo\vfs\vfsStream;

class CacheTest extends PHPUnit_Framework_TestCase
{

    private $root;
    private $dir;
    private $cache;

    public function setUp()
    {
        $this->root = vfsStream::setup('root');
        $this->dir = vfsStream::url('root/data');
        $this->cache = new Cache($this->dir);
    }
    
    public function tearDown()
    {
        $this->root = NULL;
        $this->dir = NULL;
        $this->cache = NULL;
    }

    public function testPrepare()
    {
        // precheck
        $this->assertFalse($this->root->hasChild('data'), 'incorrect setUp');
        
        // test
        $this->cache->prepare();

        // check
        $this->assertTrue($this->root->hasChild('data'), 'directory not found');
    }
    
    public function testSetAndGet() {
        
        $cache = $this->cache;
        $cache->prepare();
        
        
    }
}