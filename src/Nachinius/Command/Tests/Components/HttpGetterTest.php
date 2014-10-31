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

    public function testGet() {
        
        /* $httpGetter = new HttpGetter();
        
        $html = $httpGetter->get('http://www.google.com');
        
        $this->assertNotEmpty($html); */
    }
    
}

