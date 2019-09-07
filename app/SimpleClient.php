<?php

namespace App;


class SimpleClient
{

    public function __construct() {

    }


    /**
     *
     *
     * @param  string
     * @return string
     */
    public function getDataFromSource($url)
    {
        $opts = ['http' => ['method' => 'GET', 'header' => ['User-Agent: PHP']]];
        $context = stream_context_create($opts);

        $json = file_get_contents($url, false, $context);
        $obj = json_decode($json, true);

        return $obj;
    }



}