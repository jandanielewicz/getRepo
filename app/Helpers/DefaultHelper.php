<?php

namespace App\Helpers;


class DefaultHelper extends Helper
{
    /**
     * The signature of the command.
     *
     * @var string
     */
//    protected $signature = 'default {name=Artisan} {service}';
    protected $signature = 'default {check} {--service=github}';

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

        $opts = ['http' => ['method' => 'GET', 'header' => ['User-Agent: PHP']]];
        $context = stream_context_create($opts);
        $json = file_get_contents("https://api.github.com/repos/google/blueprint/commits", false, $context);
        $obj = json_decode($json, true);
//         $first = array_shift($obj);
         var_dump($obj[0]['sha']);
        $arg = $this->arguments();
        $option = $this->option();
        var_dump($arg);
        var_dump($option);

//        foreach ($obj as $o) {
//
//            var_dump($o['sha']);
//            break;
//        }


        $this->info('123 Simplicity is the ultimate sophistication.');
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
