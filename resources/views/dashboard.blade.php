@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header>
                <h3>What do you have to say?</h3>
                <form action="{{route('post.create')}}" method="post">
                    <div class="form-group">
                        <textarea class="form-control" name="body" id="body" cols="30" rows="5" placeholder="New Post"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit" name="button">Create Post</button>
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                </form>
            </header>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header>
                <h3>What other people say...</h3>
            </header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{$post->id}}">
                    <p>
                        {{$post->body}}
                    </p>
                    <div class="info">
                        Posted by {{$post->user->first_name}} on {{$post->updated_at}}
                    </div>
                    <div class="interaction">
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                                                <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>

                        @if(Auth::user() == $post->user)
                            |
                            <a href="#" class="edit-modal-btn">Edit</a> |
                            <a href="{{ route('post.delete', ['post_id'=>$post->id]) }}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
    @include('includes.editmodal')

    <script>
        var token = '{{Session::token()}}';
        var urlEdit = '{{route('edit')}}';
        var urlLike = '{{route('like')}}';
    </script>
@endsection
