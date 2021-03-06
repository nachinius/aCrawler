<?php
use \PHPUnit_Framework_TestCase;
use Nachinius\Command\Components\SimpleFSCache;
use org\bovigo\vfs\vfsStream;
use Symfony\Component\Filesystem\Filesystem;

class SimpleFSCacheTest extends PHPUnit_Framework_TestCase
{

    private $root;

    private $dir;

    private $cache;

    public function setUp()
    {
        $this->root = vfsStream::setup('root');
        $this->dir = vfsStream::url('root/data');
        $fs = new Filesystem();
        $this->cache = new SimpleFSCache($this->dir, $fs);
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

    public function dataKeysAndFilenames()
    {
        return array(
            array(
                '123',
                '123-'.md5('123')
            ),
            array(
                'a/este',
                'este-' . md5('a/este')
            ),
            array(
                'a/este/esto',
                'esto-' . md5('a/este/esto')
            )
        );
    }

    /**
     * @dataProvider dataKeysAndFilenames
     */
    public function testkeyToFilename($key, $expectedFilename)
    {
        $filename = $this->cache->keyToFilename($key);
        $this->assertEquals($expectedFilename, $filename);
    }

    public function dataKeyContent()
    {
        return array(
            array('1','kjsadfjksadf'),
            array('primer','textinserted')
        );
    }

    /**
     * @dataProvider dataKeyContent
     *
     * @param unknown $key            
     * @param unknown $content            
     */
    public function testSetAndGet($key, $content)
    {
        $cache = $this->cache;
        $cache->prepare();
        
        $this->assertEmpty($cache->get($key));
        $cache->set($key, $content);
        $this->assertEquals($content, $cache->get($key));
    }
}