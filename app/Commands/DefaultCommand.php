<?php

namespace App\Commands;

use App\Traits\SendUrlCommands;


use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\Client;
use Exception;

class DefaultCommand extends Command
{

    use SendUrlCommands;

    /**
     * Do zrobienia:
     * - jakis dispatcher - ze klasa GitHub domyslna, albo inna
     * - i mapper do tego
     * i struktyra dla tych klas guthub i innej, ze jakis tam.. interfejs?
     */

    /**
     * The signature of the command.
     *
     * @var string
     */
//    protected $signature = 'default {name=Artisan} {service}';
    protected $signature = 'default {reponame}  {branchname} {--service=github}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Display an default quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    protected function getClientClassByServiceMapping($service)

    {
        switch ($service) {
            case 'github':
                return Client::class;
            case 'bitbucket':
                return Client::class;
            default:
                return Client::class;
        }

    }

    /**
     * @param $service
     * @param $repoName
     * @param $branchName
     * @return string
     */
    protected function getClientUrlByService($service, $repoName, $branchName)

    {
        switch ($service) {
            case 'github':
                return   "https://api.github.com/repos/" . $repoName . "/commits?sha="  .$branchName;
            default:
                return Client::class;
        }

    }

    public function handle()
    {

        $repoName = $this->argument('reponame');
        $branchName = $this->argument('branchname');

        $service = $this->option('service');

        if (strpos($repoName, '/') === false) {
            throw new Exception('Podaj repo w formacie xxx/yyyy');
        }

        var_dump($repoName);
        var_dump($branchName);
        var_dump($service);
//        $url = "https://api.github.com/repos/{$repoName}/commits?sha={$branchName}";
        $url = $this->getClientUrlByService($service, $repoName, $branchName);
//        $url = $urlParts[0] . $repoName . $urlParts[1] .$branchName;

        $lastShaForBranch = $this->getLastShaForBranch($url);
//        $this->runShellCommand("git help -b {} --single-branch {$url} {$targetDir}");
//
//
//        $ghClassName = $this->getClientClassByServiceMapping($service);
//        $gh = new $ghClassName();
//        $lastShaForBranch = $gh->getLastShaForBranch($repoName, $branchName, $service);
//

        var_dump($lastShaForBranch);

        $this->info($lastShaForBranch);
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule)
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
