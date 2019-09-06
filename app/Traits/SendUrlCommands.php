<?php

declare(strict_types = 1);

namespace App\Traits;

trait SendUrlCommands
{


    /**
     * Executes a shell command.
     *
     * @param  string
     * @return string
     */
    protected function getLastShaForBranch($url)
    {
        $args = func_get_args();
//        $url = self::processCommand($args);

//        exec($url . '2>&1', $output, $exitCode);
//
//        if (0 !== $exitCode) {
//            throw new \RuntimeException("eeeeeeeeee Command '$url' failed with exit code $exitCode.");
//        }
//
//        return $this;

    var_dump('$url, ', $url);

        $opts = ['http' => ['method' => 'GET', 'header' => ['User-Agent: PHP']]];
        $context = stream_context_create($opts);


        //commits?sha=branch_name daje dane nt. brancha
        $json = file_get_contents($url, false, $context);
        $obj = json_decode($json, true);

        $lastCommitSha = $obj[0]['sha'];

        return $lastCommitSha;
    }


//
//    protected static function processCommand(array $args) : string
//    {
//        $url = [];
//        $executable = array_shift($args);
//        foreach ($args as $arg) {
//            if (is_array($arg)) {
//                foreach ($arg as $key => $value) {
//                    $c = '';
//                    if (is_string($key)) {
//                        $c = "$key ";
//                    }
//                    $url[] = $c . escapeshellarg($value);
//                }
//            } elseif (is_scalar($arg) && ! is_bool($arg)) {
//                $url[] = escapeshellarg($arg);
//            }
//        }
//
//        return "$executable " . implode(' ', $url);
//    }
}
