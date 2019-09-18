<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CommentController extends Controller
{
    public function index()
    {


        $redis = Redis::connection();
        $post = Post::find(12);
        $user = \auth()->user();

        $redis->sadd("post{$post->id}:likes", $user->id);
        $redis->sadd("user{$user->id}:likes", $post->id);

        dd($redis->scard("post{$post->id}:likes"));
    }
}
