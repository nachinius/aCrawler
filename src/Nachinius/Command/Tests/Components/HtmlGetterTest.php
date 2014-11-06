<?php
use \PHPUnit_Framework_TestCase;
use Nachinius\Command\Components\HtmlGetter;

class HtmlGetterTest extends PHPUnit_Framework_TestCase
{

    private function getTextSample()
    {
        return <<<'HTML'
            <html>
            <head></head>
            <body>
                <table>
                    <tr><td></td></tr>
                </table>
            </body>
            </html>
HTML;
    }

    private function getMockHttpGetter()
    {
        $mock = $this->getMock('Nachinius\Command\Components\HttpGetter');
        
        return $mock;
    }
    
    private function getMockCache() {
        
        $mockCache = $this->getMock('Nachinius\Command\Components\CacheInterface');
        
        return $mockCache;
    }

    public function testHtmlGotItFromHttp()
    {
        
        // input data
        $url = 'http://fakeaddress.com';
        $text = $this->getTextSample();
        
        // prepare mock
        $mock = $this->getMockHttpGetter();
        $mock->expects($this->any())->method('get')
            ->with($this->equalTo($url))
            ->willReturn($text);
        
        // test
        $htmlGetter = new HtmlGetter($mock);
        $html = $htmlGetter->execute($url);
        
        // assert
        $this->assertEquals($text, $html, 'Html is not correct');
    }

    public function testHtmlFoundInCache()
    {
        $url = 'http://here.com';
        $text = $this->getTextSample();
        
        $mockCache = $this->getMockCache();
        $mockCache->expects($this->once())
            ->method('get')
            ->with($this->equalTo($url))
            ->willReturn($text);
        $mockCache->expects($this->once())
            ->method('set')
            ->with($this->equalTo($url))
            ->willReturn('');
        
        // test
        $htmlGetter = new HtmlGetter(NULL, $mockCache);
        $html = $htmlGetter->execute($url);
        
        // assert
        $this->assertEquals($text, $html, 'Html is not correct');
    }

    public function testWhenCacheIsEmpty()
    {
        
        $url = 'http://localhost.com';
        $text = $this->getTextSample();
        
        // cache data
        $mockCache = $this->getMockCache();
        $mockCache->expects($this->once())
            ->method('get')
            ->with($this->equalTo($url))
            ->willReturn('');
        $mockCache->expects($this->once())
            ->method('set')
            ->with($this->equalTo($url), $this->equalTo($text));
        
        // cache http
        $mockHttpGetter = $this->getMockHttpGetter();
        $mockHttpGetter->expects($this->once())->method('get')->with($this->equalTo($url))->willReturn($text);
        
        $htmlGetter = new HtmlGetter($mockHttpGetter, $mockCache);
        $html = $htmlGetter->execute($url);
        
        $this->assertEquals($text, $html, 'Html is not correct');
    }
    
    public function testIgnoreCacheWhenExceptionOnCache() {
        $url = 'http://any.com';
        $text = $this->getTextSample();
        
        $mockCache = $this->getMockCache();
        $mockCache->expects($this->any())
            ->method('get')
            ->willThrowException(new Exception('unknown error'));
        
        $mockHttpGetter = $this->getMockHttpGetter();
        $mockHttpGetter->expects($this->once())->method('get')->with($this->equalTo($url))->willReturn($text);
        
        $htmlGetter = new HtmlGetter($mockHttpGetter, $mockCache);
        $html = $htmlGetter->execute($url);
        
        $this->assertEquals($text, $html, 'Html is not correct when cache throws exception');
    }
    
}