@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @if (Session::has('sorry'))

                <div class="alert alert-info">{{ Session::get('sorry') }}</div>

            @endif
        </div>
        <div class="row">
            <div class="col-md-6">
              <h1>Chat hi write </h1>

                @foreach($chats as $chat)
                 {{ $chat->message }}
                    <hr>
                @endforeach
            </div>
             <div class="col-md-6">
            <form action="{{route('chat.new',$user->id)}}" method="post">
                    @csrf
                <textarea name="chat" id="" cols="30" rows="10"></textarea>
                <input type="hidden"  name="to" value="{{$user->id}}">
                <input type="submit" value="Send" class="btn btn-primary">
            </form>
            </div>
        </div>
    </div>

@endsection
