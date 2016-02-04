@extends('layouts.admin')

@section('title', "Пользователи")

@section('content')
    <table class="table" id="users">
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Дата регистрации</th>
            <th>Администратор</th>
            <!-- <th>#</th> -->
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <form method="POST" action="/admin/users/adminstatus/{{$user->id}}">
                        {!! csrf_field() !!}
                        <button class="btn btn-info" type="submit">{{$user->is_admin}}</button>
                    </form>
                    
                </td>
                <!-- <td>
                    <a href="/admin/users/edit_user/{{$user->id}}">Р</a>
                </td> -->
            </tr>
        @endforeach
        {!! $users->links() !!}
    </table>
@endsection