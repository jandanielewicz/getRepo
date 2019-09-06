<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientAbstract
{

    private $mapping = [
        'github' => ''
    ];

    public function __construct () {
//        $gh = $this->getLastShaForBranch();
    }

    public function getLastShaForBranch($repoName, $branchName, $option) {
        $opts = ['http' => ['method' => 'GET', 'header' => ['User-Agent: PHP']]];
        $context = stream_context_create($opts);
        $json = file_get_contents("https://api.github.com/repos/" . $repoName . "/commits?sha=" . $branchName, false, $context);
        $obj = json_decode($json, true);
//         $first = array_shift($obj);
//        var_dump();

        $lastCommitSha = $obj[0]['sha'];

//        foreach ($obj as $o) {
//
//            var_dump($o['sha']);
//            break;
//        }


        return $lastCommitSha;

    }

}