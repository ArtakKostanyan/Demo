<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'user_id'
    ];

    public function status()
    {
        return $this->hasMany(PostStatus::class)->where('status', 1);
    }

    public function postStatus(){

        return $this->hasMany(PostStatus::class);

    }

    public function statusInfo()
    {

        return $this->status()->count() === 3 ? "Approved" : "Pending";

    }


    public function acceptFirst(User $user) : bool {

      return  !! PostStatus::where( 'user_id',$user->id)->where('post_id',$this->id)->first();
    }

    public function isPublic(){

        return $this->status()->count() === 3 ? true : false;
    }


    public function comments(){

        return $this->hasMany(Comment::class);
    }


    public function dislike(User $user){
        $redis = Redis::connection();
        $redis->srem("post{$this->id}:likes", $user->id);
        $redis->srem("user{$user->id}:likes", $this->id);
    }

    public function like(User $user){

        $redis = Redis::connection();
        $redis->sadd("user{$user->id}:likes", $this->id);
        $redis->sadd("post{$this->id}:likes", $user->id);
    }


    public function likeCount( ){

        $redis = Redis::connection();
        return $redis->scard("post{$this->id}:likes");
    }

    public function isLikedBY(User $user){

        $redis = Redis::connection();
       return $redis->sismember("post{$this->id}:likes", $user->id);
    }

}
