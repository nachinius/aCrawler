<?php
namespace Nachinius\Command\Components;

/**
 * 
 * @author ignacio
 *
 */
class HttpGetter
{

    public function getWithCurl($url)
    {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    
    public function getWithFopen($url) {
        $html = file_get_contents($url);
        return $html;
    }
    
    public function get($url) {
        return $this->getWithFopen($url);
    }
}