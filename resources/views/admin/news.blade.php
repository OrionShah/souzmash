@extends('layouts.admin')

@section('title', "Новости")

@section('content')
    <a class="" href="/admin/news/new"><button class="new_record btn btn-submit">Добавить новость</button></a>
    <table class="table">
        <tr>
            <th>Заголовок</th>
            <th>Автор</th>
            <th>#</th>
        </tr>
        @if($count > 0)
            @foreach($news as $new)
                <tr>
                    <td>{{$new->title}}</td>
                    <td>{{$new->author}}</td>
                    <td></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3">Нет новостей<td>
            </tr>
        @endif
    </table>
@endsection