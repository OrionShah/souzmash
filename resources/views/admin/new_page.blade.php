@extends('layouts.admin')

@section('title', "Новая новость")

@section('content')

    <form method="POST" action="/admin/pages/new">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div class="row">
            <div class="form-group col-md-8">
            <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>
            <div class="form-group col-md-4">
                <label for="is_publish">Отображать в меню</label>
                <input type="checkbox" name="is_publish" id="is_publish">
            </div>
            <div class="form-group col-md-12">
                <label for="link">Ссылка</label>
                <input class="form-control" type="text" name="link" id="link">
            </div>

        </div>

        <div class="form-group">
            <label for="editor">Контент</label>
            <textarea id="editor" name="editor"></textarea>
        </div>

        <button type="submit" class="btn btn-submit">Сохранить</button>
    </form>


    <div id="elfinder"></div>

    <script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript" charset="utf-8" ></script>
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.colorbox-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/packages/barryvdh/elfinder/js/standalonepopup.min.js') }}"></script> 


    <script>
        var editor = CKEDITOR.replace('editor',
            {filebrowserBrowseUrl : '/elfinder/ckeditor'}
        );

        // 
    </script>
@endsection