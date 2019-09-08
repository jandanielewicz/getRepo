<?php

namespace App;


class Tool
{

    public function __construct() {

    }


    /**
     * @param $service
     * @param $repoName
     * @param $branchName
     * @return string
     */
    public function getClientUrlByService($service, $repoName, $branchName)

    {
        switch ($service) {
            case 'github':
                return   "https://api.github.com/repos/" . $repoName . "/commits?sha="  .$branchName;
            default:
                return false;
        }
    }

    /**
     *
     * Returns first found array value by key
     * @param array $array
     * @param $search
     * @return bool|mixed
     */
    public function searchArrayValueByKey(array $array, $search) {
        foreach (new \RecursiveIteratorIterator(new \RecursiveArrayIterator($array)) as $key => $value) {
            if ($search === $key) {
                return $value;
            }
        }
        return false;
    }

}