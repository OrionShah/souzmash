<!DOCTYPE html>
<html>
    <head>
        <title>Союз машиностроителей - @yield('title')</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('/styles/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/styles/style.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="col-md-12">
                <div class="col-md-3 logo">Союз машиностроителей</div>
                <div class="col-md-6">
                    
                </div>
                <div class="col-md-3 user">
                    @if (Auth::check())
                        Добро пожаловать,<br>{{Auth::user()->name}}
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
                            <a href="/register"><button type="button" class="btn btn-default reg">Регистрация</button></a>
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
                        
                    @endif
                </div>
            </div>
            <div class="col-md-12 sidebar">
                <ul class="head_menu">
                    @foreach($menus as $menu)
                        <a class="menu_link_a" href="{{$menu['link']}}"><li class="menu_link col-md-2">{{$menu['text']}}</li></a>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-12">
                @yield('content')
            </div>
            

        </div>

       <div class="footer">
            &copy; 2016 Союз Машиностроителей Волгограда
        </div>

    </body>
</html>