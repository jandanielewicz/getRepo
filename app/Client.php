<?php

namespace App;


class Client extends ClientAbstract
{

    private $mapping = [
        'github' => ['https://api.github.com/repos/']
    ];

    public function __construct () {
//        $gh = $this->getLastShaForBranch();

        parent::__construct();

    }

    public function getLastShaForBranch($repoName, $branchName, $option) {
        $opts = ['http' => ['method' => 'GET', 'header' => ['User-Agent: PHP']]];
        $context = stream_context_create($opts);


        //commits?sha=branch_name daje dane nt. brancha
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