<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $fillable=[
         'title','body','user_id'
     ];

            public function status(){

                return $this->hasMany(PostStatus::class)->where('status',1);
            }


    public function statusInfo(){

              return $this->status()->count()===3 ? "Approved":"Pending";

    }
}
