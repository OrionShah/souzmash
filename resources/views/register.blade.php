@extends('layouts.master')

@section('title', 'Регистрация')

@section('content')
    <form method="POST" action="/auth/register" class="col-md-12 register_form">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="email">Ваш email: </label>
            <input class="form-control" type="email" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
            <label for="name">Ваше имя: </label>
            <input class="form-control" type="text" name="name" placeholder="Имя">
        </div>
        <div class="form-group">
            <label for="password">Пароль: </label>
            <input class="form-control" type="password" name="password" placeholder="Пароль">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Повторите пароль: </label>
            <input class="form-control" type="password" name="password_confirmation" placeholder="Повторите пароль">
        </div>
        <button type="submit" class="btn btn-default">Зарегистрироваться</button>
    </form>
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
@stop