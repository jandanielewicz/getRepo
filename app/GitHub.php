<?php

namespace App;


class GitHub
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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