@extends('layouts.admin')

@section('title', "Страницы")

@section('content')
    <a class="" href="/admin/pages/new"><button class="new_record btn btn-submit">Добавить страницу</button></a>
    <table id="pages" class="table">
        <tr>
            <th>№</th>
            <!-- <th>ID</th> -->
            <th>Заголовок</th>
            <th>Ссылка</th>
            <th>Создано</th>
            <th>Обновлено</th>
            <th>#</th>
        </tr>
        @if($count > 0)
            @foreach($pages as $key => $page)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{$page->title}}</td>
                    <td><a href="/{{$page->link}}">{{$page->link}}</a></td>
                    <td>{{$page->created_at}}</td>
                    <td>{{$page->updated_at}}</td>
                    <td>
                        <a href="/admin/pages/edit/{{$page->id}}">Р</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5">Нет страниц<td>
            </tr>
        @endif
    </table>
    {!! $pages->links() !!}
@endsection