@extends('layouts.master')

@section('title', "$page->title")

@section('content')
    <div class="content"> 
        {!! $page->content !!}
    </div>
@endsection