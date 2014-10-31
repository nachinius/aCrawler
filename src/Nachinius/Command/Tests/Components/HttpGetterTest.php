<?php
use \PHPUnit_Framework_TestCase;
use Nachinius\Command\Components\HttpGetter;

class HttpGetterTest extends PHPUnit_Framework_TestCase
{
    private $root;

    public function setUp()
    {
        $this->root = vfsStream::setup('root');
    }

    public function testGet() {
        
        $httpGetter = new HttpGetter();
        
        $httpGetter->get('http://www.google.com');
    }
    
}

