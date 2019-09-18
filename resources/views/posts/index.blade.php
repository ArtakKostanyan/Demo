@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Manage Posts</h1>
                <a href="{{ route('post.create') }}" class="btn btn-success" style="float: right">Create Post</a>
                <table class="table table-bordered">
                    <thead>
                    <th width="80px">Id</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Accept</th>

                    <th width="150px">Action</th>
                    </thead>
                    <tbody>
                    @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->statusInfo()  }}</td>
                            <td>

                            @if (Auth::user()->cant('accept', $post))
                                    <form action="{{ route('post.accept',$post->id) }} " method="post">
                                        @csrf
                                        <input name="accept" type="submit" value="Accept" class="btn btn-info">
                                    </form>
                             @else

                                    <input  value="Accepted" class="btn btn-success">
                              @endif
                            </td>
                            <td>
                                <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">View Post</a>
                            </td>
                            <td>
                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-dark">Edit Post</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

