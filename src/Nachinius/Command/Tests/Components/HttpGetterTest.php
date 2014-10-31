<?php
use \PHPUnit_Framework_TestCase;
use Nachinius\Command\Components\HttpGetter;
use org\bovigo\vfs\vfsStream;

class HttpGetterTest extends PHPUnit_Framework_TestCase
{
    private $root;

    public function setUp()
    {
        //$this->root = vfsStream::setup('root');
    }

    
    public function testGetWithFopen() {
    
        $url = 'http://www.google.com';
    
        $httpGetter = new HttpGetter();
    
        $html = $httpGetter->getWithFopen($url);
        $this->assertNotEmpty($html);
    }
    
    public function testGet() {
        $url = 'http://www.google.com';
        
        $httpGetter = new HttpGetter();
        
        $html = $httpGetter->get($url);
        $this->assertNotEmpty($html);
    }
}

