<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $id=auth()->user()->id;
        $role=auth()->user()->roles->first()->role_name;
        $users=User::where('id','!=',$id)->whereHas('roles', function($q) use ($role){
            $q->where('role_name', $role);
        })->get();


           return view('users.index')->with(['users'=>$users]);
    }
}
