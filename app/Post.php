<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
