<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisTestWithRedisFacadeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:redis-facade';

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
        Redis::set('some_key', 'some_value');  // создание, в DB0 - по умолч.

        $post = Post::find(1);
        Redis::set('posts:' . $post->id, $post);  // создание, в DB0 - по умолч.

        $post = Redis::get('posts:' . $post->id); // вернет string, а не коллекцию, как Cache::
        // Поэтому, чтобы снова получить Post:
        $post = Post::make((array)json_decode($post));

        $post2 = Redis::lpush('posts_list', 'some_post', 'another_post');
        // dd(Redis::lrange('posts_list', 0, -1));
        // dd(Redis::lindex('posts_list', 1));

    }
}
