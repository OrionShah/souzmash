<!DOCTYPE html>
<html>
<head>
	<title>Администрация - @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/styles/admin.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('/styles/bootstrap.min.css') }}">
        <link href="{{ asset('/styles/colorbox.css') }}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="col-md-12 col-xs-12 header">Административная часть сайта</div>
		<div class="col-md-3 col-xs-12">
			<ul class="sibebar">
				<li class="menu_link"><a href="/">На сайт</a></li>
				<li class="menu_link"><a href="/admin">Доска</a></li>
				<li class="menu_link"><a href="/admin/news">Новости</a></li>
				<li class="menu_link"><a href="/admin/users">Пользователи</a></li>
				<li class="menu_link"><a href="/admin/pages">Страницы</a></li>
			</ul>
		</div>
		<div class="col-md-9 col-xs-12">
			@yield('content')
		</div>
	</div>
</body>
</html>