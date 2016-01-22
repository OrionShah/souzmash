<!DOCTYPE html>
<html>
<head>
	<title>Администрация - @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="/styles/admin.css">
        <link rel="stylesheet" type="text/css" href="/styles/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="col-md-12 col-xs-12 header">Шапка</div>
		<div class="col-md-3 col-xs-12">
			<ul class="sibebar">
				<li class="menu_link"><a href="/">На сайт</a></li>
				<li class="menu_link"><a href="/admin">Доска</a></li>
				<li class="menu_link"><a href="/admin/news">Новости</a></li>
				<li class="menu_link"><a href="/admin/users">Пользователи</a></li>
			</ul>
		</div>
		<div class="col-md-9 col-xs-12">
			@yield('content')
		</div>
	</div>
</body>
</html>