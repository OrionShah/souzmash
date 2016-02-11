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
				<a href="/"><li class="menu_link">На сайт</li></a>
				<a href="/admin"><li class="menu_link">Доска</li></a>
				<a href="/admin/news"><li class="menu_link">Новости</li></a>
				<a href="/admin/users"><li class="menu_link">Пользователи</li></a>
				<a href="/admin/pages"><li class="menu_link">Страницы</li></a>
			</ul>
		</div>
		<div class="col-md-9 col-xs-12">
			@yield('content')
		</div>
	</div>
</body>
</html>