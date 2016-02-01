@extends('layouts.master')

@section('title', "$post->title")

@section('content')
    <div class="post_content">
        {!! $post->content !!}
    </div>
@endsection