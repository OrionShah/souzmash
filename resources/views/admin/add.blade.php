@extends('layouts.admin')

@section('title', "Новая новость")

@section('content')

    <form method="POST" action="/admin/addnew">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="row">
            <div class="form-group col-md-8">
            <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="is_publish">Отображать на сайте</label>
                <input type="checkbox" name="is_publish" id="is_publish">
            </div>
        </div>
        <div class="form-group">
            <label for="preview_image">Превью изображение</label>
            <input type="file" class="form-control" id="preview_image" name="preview_image">
        </div>
        <div class="form-group">
            <label for="editor">Контент</label>
            <textarea id="editor" name="editor"></textarea>
        </div>
        <div class="form-group">
            <label for="comments">Разрашить комментарии?</label>
            <input type="checkbox" name="comments" id="comments">
        </div>

        <button type="submit" class="btn btn-submit">Сохранить</button>
    </form>

    <script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript" charset="utf-8" ></script>
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" src="{{ asset('/packages/barryvdh/elfinder/js/standalonepopup.min.js') }}"></script>
    <script>
        var editor = CKEDITOR.replace('editor',
            {filebrowserBrowseUrl : '/elfinder/ckeditor'}
        );
    </script>
@endsection