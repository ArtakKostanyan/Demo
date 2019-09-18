@extends('layouts.app')
 @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Post</div>
                    <div class="card-body">

                        <form method="post" action="{{ route('post.update',$post->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">

                                <label class="label">Post Title: </label>
                                <input type="text" name="title" class="form-control" required value="{{ $post->title }}"/>
                            </div>
                            <div class="form-group">
                                <label class="label">Post Body: </label>
                                <textarea name="body" rows="10" cols="30" class="form-control" required> {{ $post->body }}</textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" />
                            </div>
                        </form>
                    </div>
                    <form  action="{{route('post.destroy',$post->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Delete">
                    </form>
                </div>


                @include('../error' )
            </div>
        </div>
    </div>
@endsection
