<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostStatus extends Model
{
    protected $fillable = [

        'post_id', 'user_id'
    ];


    public function getStatusAttribute($value)
    {


        if ($value){

            return "Approved";
        }else{

            return "Pending";
        }
    }
}
