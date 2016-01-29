@extends('layouts.admin')

@section('title', "Новости")

@section('content')
    <a class="" href="/admin/news/new"><button class="new_record btn btn-submit">Добавить новость</button></a>
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Автор</th>
            <th>Создано</th>
            <th>Обновлено</th>
            <th>#</th>
        </tr>
        @if($count > 0)
            @foreach($news as $new)
                <tr>
                    <td>{{$new->id}}</td>
                    <td>{{$new->title}}</td>
                    <td>{{$new->author}}</td>
                    <td>{{$new->created_at}}</td>
                    <td>{{$new->updated_at}}</td>
                    <td>
                        <a href="/admin/news/edit/{{$new->id}}">Р</a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">Нет новостей<td>
            </tr>
        @endif
    </table>
    {!! $news->links() !!}
@endsection