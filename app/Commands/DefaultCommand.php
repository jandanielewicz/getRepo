<?php

namespace App\Commands;

use App\SimpleClient;
use App\Tool;
use App\Enum\Enum;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class DefaultCommand extends Command
{

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'default {reponame} {branchname} {--service=github}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Display an default quote';


    public function handle()
    {
        $repoName = $this->argument('reponame');
        $branchName = $this->argument('branchname');

        $service = $this->option('service');

        if (strpos($repoName, '/') === false) {
            $this->error(Enum::REPO_WRONG_FORMAT);
            return false;
        }

        $tool = new Tool();
        $url = $tool->getClientUrlByService($service, $repoName, $branchName);

        if (empty($url)) {
            $this->error(sprintf(Enum::REPO_TYPE_NOT_AVAILABLE . ' %s', $service));
            return false;
        }

        $dataFromSource = (new SimpleClient())->getDataFromSource($url);
        $lastShaForBranch = $tool->searchArrayValueByKey($dataFromSource, 'sha');

        if (empty($lastShaForBranch)) {
            $this->error(Enum::SHA_NOT_FOUND);
            return false;
        }

        $this->info($lastShaForBranch);
    }


}
