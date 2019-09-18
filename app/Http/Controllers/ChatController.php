<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    private function check(User $user): bool
    {
        return auth()->user()->roles->first()->role_name == $user->roles->first()->role_name;
    }

    public function index(Request $request, User $user)
    {


        if ($this->check($user)) {

            $chats = Chat::where('from_id', $user->id)->where('to_id', auth()->user()->id)->get();

        } else {

            return redirect('user')->with('sorry', 'You can`t chat with that user');
        }


        return view('chat.index', compact('user', 'chats'));
    }

    public function newChat(Request $request, User $user)
    {
        $chat = Chat::create([

            'from_id' => auth()->user()->id,
            'to_id' => $user->id,//$request->to,
            'message' => $request->chat
        ]);

        return back();
    }
}
