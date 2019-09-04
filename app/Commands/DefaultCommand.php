<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use App\GitHub;

class DefaultCommand extends Command
{
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
    public function handle()
    {

//        $opts = ['http' => ['method' => 'GET', 'header' => ['User-Agent: PHP']]];
//        $context = stream_context_create($opts);
//        $json = file_get_contents("https://api.github.com/repos/google/blueprint/commits", false, $context);
//        $obj = json_decode($json, true);
////         $first = array_shift($obj);
//         var_dump($obj[0]['sha']);
//        $arg = $this->arguments();
//        $service = $this->option();
//        var_dump($arg);
//        var_dump($service);
//
////        foreach ($obj as $o) {
////
////            var_dump($o['sha']);
////            break;
////        }




        $repoName = $this->argument('reponame');
        $branchName = $this->argument('branchname');

        $service = $this->option('service');

        var_dump($repoName);
        var_dump($branchName);
        var_dump($service);



        $gh = new GitHub();
        $lastShaForBranch = $gh->getLastShaForBranch($repoName, $branchName, $service);


//        var_dump($lastShaForBranch);

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
