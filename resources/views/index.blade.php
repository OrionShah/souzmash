@extends('layouts.master')

@section('title', "Главная")

@section('content')
    <div class="posts">
        @foreach($posts as $post)
            <div class="post">

                @if (!empty($post->preview_image))
                    <div class="preview col-md-4 col-xs-12">
                        <img src="{{ $post->preview_image }}">
                    </div>
                    <div class="col-md-8 right">
                        <div class="header col-md-12">
                            {{ $post->title }}
                        </div>
                        <div class="block_content col-md-12">
                            {!! $post->content !!}
                        </div>
                    </div>
                    <div class="pull-right block_footer col-md-8 col-xs-12">
                @else
                    <div class="col-md-12 right">
                        <div class="header col-md-12">
                            {{ $post->title }}
                        </div>
                        <div class="block_content col-md-12">
                            {!! $post->content !!}
                        </div>
                    </div>
                    <div class="pull-right block_footer col-md-12 col-xs-12">
                @endif

                
                    <div class="more col-md-9 col-xs-6"><a href="/post/{{$post->id}}">Читать далее</a></div>
                    <div class="date col-md-3 col-xs-6">{{ $post->time }}</div>
                </div>
            </div>
        @endforeach
        <div class="links col-md-12">
            {!! $posts->links() !!}
        </div>
        
    </div>
@endsection