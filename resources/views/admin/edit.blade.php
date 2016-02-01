@extends('layouts.admin')

@section('title', "Новая новость")

@section('content')

    <form method="POST" action="/admin/news/edit">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{$new->id}}">
        <div class="row">
            <div class="form-group col-md-8">
            <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$new->title}}">
            </div>
            <div class="form-group col-md-4">
                <label for="is_publish">Отображать на сайте</label>
                @if ($new->is_publish)
                    <input type="checkbox" name="is_publish" id="is_publish" checked>
                @else
                    <input type="checkbox" name="is_publish" id="is_publish">
                @endif
                
            </div>
        </div>
        <div class="form-group">
            <label for="preview_image">Превью изображение</label>
            <input type="text" class="form-control" id="preview_image" name="preview_image" value="{{ $new->preview_image }}">
            <a href="" class="popup_selector" data-inputid="preview_image">Select Image</a>
        </div>
        <div class="form-group">
            <label for="editor">Контент</label>
            <textarea id="editor" name="editor" value="{{$new->content}}"></textarea>
            <!-- {{$new->content}} -->
        </div>
        <div class="form-group">
            <label for="comments">Разрашить комментарии?</label>
            @if ($new->comments)
                <input type="checkbox" name="comments" id="comments" checked>
            @else
                <input type="checkbox" name="comments" id="comments">
            @endif
            
        </div>
        <button type="submit" class="btn btn-submit">Сохранить</button>
    </form>

    <form id="delete_form" method="POST" action="/admin/news/delete">
        <input class="form-control" type="hidden" name="_token" value="{{csrf_token()}}">
        <input class="form-control" type="hidden" name="id" value="{{$new->id}}">
        <button type="submit" class="btn btn-danger">Удалить</button>
    </form>

    <script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript" charset="utf-8" ></script>
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.colorbox-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/packages/barryvdh/elfinder/js/standalonepopup.min.js') }}"></script>
    <script>
        var editor = CKEDITOR.replace('editor',
            {filebrowserBrowseUrl : '/elfinder/ckeditor'}
        );
        
        CKEDITOR.instances.editor.setData("{!! $new->content !!}");
    </script>
@endsection