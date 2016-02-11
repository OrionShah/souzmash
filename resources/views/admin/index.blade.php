@extends('layouts.admin')

@section('title', "Главная")

@section('content')
 <div class="block comments col-md-6">
    <div class="block_header">
        Последние комментарии
    </div>
    @foreach ($comments as $comment)
        <div class="comment col-md-12">
            <div class="author col-md-6">{{ $comment->author }}</div>
            <div class="post col-md-6"><a href="/post/{{ $comment->post_id }}">{{ $comment->post }}</a></div>
            <div class="text col-md-12">{{ $comment->text }}</div>
            <div class="buttons col-md-6">
                <form class="form" action="/delcomment" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="user" value="{{$comment->author}}">
                    <input type="hidden" name="comment_Id" value="{{$comment->id}}">
                    <button class="btn btn-danger" type="submit">Удалить</button>
                </form>
            </div>
            <div class="time col-md-6">{{ $comment->created_at }}</div>
        </div>
    @endforeach
    {!! $comments->links() !!}
 </div>
@endsection