@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (Session::has('sorry'))

                <div class="alert alert-info">{{ Session::get('sorry') }}</div>

            @endif
        </div>


        <div class="row justify-content-center">


            <div class="col-md-12">
                <h1>Manage Posts</h1>
{{--                <a href="{{ route('post.create') }}" class="btn btn-success" style="float: right">Create Post</a>--}}
                <table class="table table-bordered">
                    <thead>
                    <th width="80px">Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Chat</th>

                    <th width="150px">Action</th>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email  }}</td>
                            <td>
                                <a class="btn btn-link" href="{{route('chat.index',$user->id)}}">New Chat</a>
                            </td>


                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

