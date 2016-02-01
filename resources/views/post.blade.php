@extends('layouts.master')

@section('title', "$post->title")

@section('content')
    <div class="post_content">
        {!! $post->content !!}
    </div>

    @if ($post->comments)
        <div class="comments">
        @if ($comments_count > 0)
            @foreach ($comments as $comment)
                <div class="comment col-md-12">
                    <div class="author col-md-4">{{$comment->author}}</div>
                    <div class="time col-md-8">{{$comment->time}}</div>
                    <div class="text col-md-12">{{ $comment->text }}</div>
                </div>
            @endforeach
        @endif
        @if ( Auth::check())
            <form class="form" id="new_comment" method="POST" action="/comment/{{$post->id}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="id" value="{{$post->id}}">
                <div class="form-group">
                    <label for="text">Введите комментарий</label>
                    <textarea class="form-control" name="text" id="text"></textarea>
                    <button class="btn btn-submit">Отправить</button>
                </div>
                
            </form>
        @endif
        </div>
    @endif
    
@endsection