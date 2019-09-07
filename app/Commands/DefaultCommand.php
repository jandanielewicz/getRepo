<?php

namespace App\Commands;

use App\SimpleClient;
use App\Tool;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Exception;

class DefaultCommand extends Command
{

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'default {reponame}  {branchname} {--service=github}';

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
            throw new Exception('Podaj repo w formacie xxx/yyyy');
        }

        if ($service !== 'github') {
            throw new Exception('Na razie nie obsługiwane');
        }

        $tool = new Tool();
        $url = $tool->getClientUrlByService($service, $repoName, $branchName);
        $dataFromSource = (new SimpleClient())->getDataFromSource($url);
        $lastShaForBranch = $tool->searchArrayValueByKey($dataFromSource, 'sha');

        $this->info($lastShaForBranch);
    }


}
