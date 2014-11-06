<?php
use \PHPUnit_Framework_TestCase;
use Nachinius\Command\Components\ZendCacheAdapter;
use Zend\cache\storage\StorageInterface;

class ZendCacheAdapterTest extends PHPUnit_Framework_TestCase {
    
    
    public function testSetContentPassThrough() {
        
        $key = 'key';
        $content = 'this si the content';

        $zendCache = $this->getMock('Zend\Cache\Storage\StorageInterface');
        
        // expect
        $zendCache->expects($this->atLeastOnce())->method('setItem')->with($key,$content);
        
        // prepare
        $adapter = new ZendCacheAdapter($zendCache);
        
        // test
        $adapter->set($key, $content);
    }
    
    public function testGet() {
        
        $key = 'key';
        $content = 'this is the content';
        
        $zendCache = $this->getMock('Zend\Cache\Storage\StorageInterface');
        
        //expect
        $zendCache->expects($this->once())->method('getItem')->with($key)->willReturn($content);

        // prepare
        $adapter = new ZendCacheAdapter($zendCache);
        
        // test 
        $contentReceived = $adapter->get($key);
        
        // verify
        $this->assertEquals($contentReceived, $content);
    }
}
