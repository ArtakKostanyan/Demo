<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use App\PostStatus;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\auth()->user()->isAdmin()){

            $posts = Post::all();
            return view('posts.index', compact('posts'));
        }else{

            return  redirect('/');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

           return view('posts.create');
          // return back()->with('error', 'dont have permissions');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        $post = $request->validated();


        $post['user_id'] = Auth::user()->id;
        $newPost = Post::create($post);
//        PostStatus::firstOrCreate([
//
//            'post_id' => $newPost->id,
//            'user_id' => $newPost->user_id
//
//        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (Auth::user()->can('view',$post)) {

            return view('posts.show', compact('post'));
        }else{

            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @return void
     */
    public function update(PostRequest $request, Post $post)
    {

        $post->update($request->all());

        return redirect('post');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        $post->delete();

        return redirect('post');
    }

    public function accept( Post $post)
    {

//        dd($post->acceptFirst(\auth()->user()));
//        if ( $post->acceptFirst()){
//
//
//        }

        PostStatus::firstOrCreate([

             'post_id' => $post->id,
             'user_id' => \auth()->user()->id,
             'status'=> 1
        ]);


//        $postStatus = PostStatus::where('post_id', $post->id)->where('status', 0)->first();
//        $postStatus->status = request()->has('accept') ? 1 : 0;
//        $postStatus->save();

        return back()->with('accept', 'OK');
    }
}
