<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        $posts = Cache::rememberForever('posts:all', function () {
            return Post::all();
        });

        //$posts = Cache::get('posts:all'); // Проверка

        dd($posts->pluck('title'));
    }

    public function show($id)
    {
        $key = 'posts:' . $id;
        if (!Cache::has($key)) return null;

        return Cache::get($key);
    }

    public function store()
    {
        $data = ['some data'];
        $post = Post::create($data);
        Cache::put('posts:' . $post->id, $post);
    }
}
