<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CommentController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'body'=>'required',
        ]);
        $input = $request->all();
        $input['user_id'] = auth()->user()->id;
        Comment::create($input);
        return back();



        $post = Post::find(12);



        dd($redis->scard("post{$post->id}:likes"));
    }

    public function like(Request $request){
        $redis = Redis::connection();
        $id =$request->post;
        $user = \auth()->user();

        $redis->sadd("post{$id}:likes", $user->id);

    }
}
