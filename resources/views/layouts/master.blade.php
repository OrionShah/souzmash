<!DOCTYPE html>
<html>
    <head>
        <title>Союз машиностроителей - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('/styles/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/styles/bootstrap.min.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-3 logo">Союз машиностроителей</div>
                <div class="col-md-5">
                    
                </div>
                <div class="col-md-4">
                    @if (Auth::check())
                        Добро пожаловать, {{Auth::user()->name}}
                        <form method="POST" action="/logout">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @if (Auth::user()->is_admin)
                            <a class="btn btn-default" href="/admin">Админ</a>
                            @endif
                            <button type="submit" class="btn btn-default">Выйти</button>
                        </form>
                    @else
                        <form method="POST" action="/login" class="form-inline login_form">
                            <input class="form-control" type="email" name="email" placeholder="E-mail"><br>
                            <input class="form-control" type="password" name="password" placeholder="Пароль">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <button type="submit" class="btn btn-default">Войти</button>
                        </form>
                        @if (isset($errors))
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li class="error">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        @endif
                        <a href="/register">Зарегистрироваться</a>
                    @endif
                </div>
            </div>
            <div class="col-md-2 sidebar">
                <ul class="head_menu">
                    @foreach($menus as $menu)
                        <li class="menu_link"><a class="menu_link_a" href="{{$menu['link']}}">{{$menu['text']}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-8">
                @yield('content')
            </div>
            
        </div>
    </body>
</html>