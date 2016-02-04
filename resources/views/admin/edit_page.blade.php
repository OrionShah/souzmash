@extends('layouts.admin')

@section('title', "Редактирование страницы")

@section('content')

    <form method="POST" action="/admin/pages/edit">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="id" value="{{$page->id}}">
        <div class="row">
            <div class="form-group col-md-8">
            <label for="title">Заголовок</label>
                <input type="text" name="title" id="title" class="form-control" value="{{$page->title}}">
            </div>
            <div class="form-group col-md-4">
                <label for="is_publish">Отображать в меню</label>
                @if ($page->is_publish)
                    <input type="checkbox" name="is_publish" id="is_publish" checked>
                @else
                    <input type="checkbox" name="is_publish" id="is_publish">
                @endif
            </div>
            <div class="form-group col-md-12">
                <label for="link">Ссылка</label>
                <input class="form-control" type="text" name="link" id="link" value="{{$page->link}}">
            </div>
        </div>

        <div class="form-group">
            <label for="editor">Контент</label>
            <textarea id="editor" name="editor" value="{{$page->content}}"></textarea>
            <!-- {{$page->content}} -->
        </div>

        <button type="submit" class="btn btn-submit">Сохранить</button>
    </form>

    <form id="delete_form" method="POST" action="/admin/pages/delete">
        <input class="form-control" type="hidden" name="_token" value="{{csrf_token()}}">
        <input class="form-control" type="hidden" name="id" value="{{$page->id}}">
        <button type="submit" class="btn btn-danger">Удалить</button>
    </form>

    <script src="{{ asset('/js/jquery.min.js') }}" type="text/javascript" charset="utf-8" ></script>
    <script src="{{ asset('/js/ckeditor/ckeditor.js') }}" type="text/javascript" charset="utf-8" ></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.colorbox-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/packages/barryvdh/elfinder/js/standalonepopup.min.js') }}"></script>
    <script type="text/template" id="content">
        {!! $page->content !!}
    </script>
    <script>
        var editor = CKEDITOR.replace('editor',
            {filebrowserBrowseUrl : '/elfinder/ckeditor'}
        );
        content = $('#content').html();
        CKEDITOR.instances.editor.setData(content);
    </script>

@endsection