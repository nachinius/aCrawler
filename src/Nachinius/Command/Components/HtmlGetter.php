<?php

namespace Nachinius\Command\Components;

class HtmlGetter {
    
    private $cache = NULL;
    
    public function __construct($httpGetter, $cache = NULL) {
        $this->httpGetter = $httpGetter;
        $this->cache = $cache;
    }
    
    public function setCache($url, $html) {
        if(!empty($this->cache)) {
            $this->cache->set($url, $html);
        }
    }
    
    public function getCache($url) {
        if(empty($this->cache)) {
            return '';
        }
        
        try {
            return $this->cache->get($url);
        } catch (\Exception $e) {
            return '';
        }
    }
    
    public function execute($url) {
        $html = $this->getCache($url);
        if(empty($html)) {
            $html = $this->httpGetter->get($url);
        }
        $this->setCache($url, $html);
        return $html;
    }
}