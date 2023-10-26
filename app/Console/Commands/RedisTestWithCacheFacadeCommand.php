<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class RedisTestWithCacheFacadeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:cache-facade';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // либо через фасад Redis:: - используется реже
        Cache::put('worker', 'my worker'); // создание, в DB1
        //Cache::put('worker', 'my worker', 60 * 60); // время жизни

        $worker = Cache::get('worker');
        Cache::forget('worker'); // удаление
        $worker = Cache::get('worker');
       // dd($worker);

//        if (Cache::has('worker2')) {
//            dump('has worker2');
//            dd(Cache::get('worker2'));
//        }
//        $worker = 'new worker';
//        Cache::put('worker2', $worker);
//        dump('has not worker2');
        //dd($worker);

        // лучше использовать:
        $worker = 'worker3';
        $result = Cache::remember('worker3', 60 * 60, fn() => $worker);
        $result = Cache::rememberForever('worker3', fn() => $worker);
        dd($result);

    }
}
