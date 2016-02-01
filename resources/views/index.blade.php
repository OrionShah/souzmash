@extends('layouts.master')

@section('title', "Главная")

@section('content')
    <div class="posts">
        @foreach($posts as $post)
            <div class="post">
                <div class="header col-md-12">{{ $post->title }}</div>
                <div class="preview col-md-3"><img src="{{ $post->preview_image }}"></div>
                <div class="content col-md-9">{!! $post->content !!}</div>
                <div class="col-md-12">
                    <div class="more col-md-9"><a href="/post/{{$post->id}}">Читать далее</a></div>
                    <div class="date col-md-3">{{ $post->time }}</div>
                </div>
            </div>
        @endforeach
        <div class="links col-md-12">
            {!! $posts->links() !!}
        </div>
        
    </div>
@endsection