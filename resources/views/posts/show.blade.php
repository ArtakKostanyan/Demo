@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">


                        <br/>
                        <h2>{{ $post->title }}</h2>
                        <p>
                            {{ $post->body }}
                        </p>
                        <hr/>
                        <h2>Comments</h2>


                        <form method="post" action="{{ route('comment.store'   ) }}">
                            @csrf
                            <div class="form-group">
                                <textarea class="form-control" name="body"></textarea>
                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Add Comment" />
                            </div>
                        </form>
                        @if($post->comments)
                            @foreach($post->comments as $comment)
                                {{ $comment->body}}
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
