<?php
namespace Nachinius\Command\Components;

class HttpGetter
{

    public function get($url)
    {
        $ch = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}