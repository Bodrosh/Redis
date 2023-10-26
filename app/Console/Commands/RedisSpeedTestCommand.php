<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class RedisSpeedTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:speed';

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
        //$posts = Post::factory(50000)->make();
        $before = microtime(true);

        // $posts = Post::all();
        // Cache::put('posts:all', $posts);
        $posts = Cache::get('posts:all2');

        //Cache::put('posts:all2', $posts);

        $after = microtime(true);

        $res = $after - $before;
        dd($res);
    }
}

/*
Тесты:

get 100 posts
0.038930892944336 sqlite (запрос)
0.019219160079956 redis
0.011796951293945 database

create 100 posts
12.931269884109 sqlite (запрос)
0.016239166259766 redis
0.17578792572021 database

make 10000 posts
0.27204990386963 redis
0.64207291603088 database

make 50000 posts
1.4305529594421 redis
3.9605498313904 database

get 50000 posts
0.59894800186157 database
1.0881109237671 redis
 */
