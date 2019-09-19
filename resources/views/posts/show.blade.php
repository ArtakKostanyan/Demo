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
                        Like:<span class="like">{{$post->likeCount()}}</span>
                        <img id="like" style="cursor: pointer" data-like="{{$post->id}}" src="{{asset('/images/like.svg')}}" width="28px" alt="like">
                        <img id="dislike" style="cursor: pointer" data-dislike="{{$post->id}}" src="{{asset('/images/dislike.svg')}}" width="28px" alt="dislike">
                        <hr/>
                        <h2>Comments</h2>


                        <form method="post" action="{{ route('comment.store' ,$post->id  ) }}">
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
                                <hr>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        jQuery(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#like').on('click', function () {
                let like=$('.like');
                let post =$(this).data('like');
                $.ajax({
                    type:'POST',
                    url: "{!! route('post.like',$post->id) !!}" ,
                    data:{post_id:post},
                    success:function(data){
                        if (data.success) {
                            like.html(data.postlike)
                        }
                        console.log(data.postlike);
                    }
                });
            })

            $('#dislike').on('click', function () {
                let like=$('.like');
                let post =$(this).data('dislike');
                $.ajax({
                    type:'POST',
                    url: "{!! route('post.dislike',$post->id) !!}" ,
                    data:{post_id:post},
                    success:function(data){
                        if (data.success) {
                            like.html(data.dislike)
                        }
                        console.log(data.dislike);
                    }
                });
            })


        })

    </script>
@endsection
