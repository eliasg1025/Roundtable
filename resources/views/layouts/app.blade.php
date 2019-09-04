<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Roundtable') }}  | Conectamos compradores de todo el mundo con alimentos peruanos 100% orgánicos y ecológicos</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Roboto|Amatic+SC:700|Poppins" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="shortcut icon" href="/img/logo/favicon.png" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/tiny-slider.css">
</head>
<body>
    <div id="app">
		<nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
			<div class="container">

				<a class="navbar-brand" href="{{ url('/') }}" style="font-family: 'Amatic SC', cursive; font-size:25px;">
					<img src="/img/logo/logo-v2.png" width="30" height="30" class="d-inline-block align-top" alt="">
					{{ config('app.name', 'Roundtable') }}
				</a>

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item mr-3">
							<a href="" class="nav-link navbar-list__link">Empresas</a>
						</li>
						<li class="nav-item mr-3">
							<a href="{{ url('/planes') }}" class="nav-link navbar-list__link">Planes</a>
						</li>
						<li class="nav-item mr-3">
							<a href="" class="nav-link navbar-list__link">Contacto</a>
						</li>
					</ul>
					<!-- Center Side Of Navbar -->
					<a id="logo" href="{{ url('/') }}" class="logo-main">
						<span style="font-family: 'Amatic SC', cursive; font-size:25px;" class="logo-main-title d-none">Rountable</span>
						<img src="/img/logo/logo-v3.png" alt="" class="img-fluid">
					</a>
					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<!-- Authentication Links -->
						@guest
							<li class="nav-item">
								<a class="nav-link navbar-list__link" href="#" data-toggle="modal" data-target="#login" id="button_login">{{ __('Iniciar Sesion') }}</a>
							</li>
							@if (Route::has('register'))
								<li class="nav-item">
									<a class="nav-link navbar-list__link" href="#" data-toggle="modal" data-target="#login" id="button_register">{{ __('Registrate') }}</a>
								</li>
							@endif
						@else
							<li class="nav-item">
								<a href="{{ route('profile') }}" class="nav-link navbar-list__link">{{ Auth::user()->name }}</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('logout') }}"
									onclick="event.preventDefault();
										document.getElementById('logout-form').submit();"
									class="nav-link navbar-list__link">
									Cerrar Sesión
								</a>
								<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									@csrf
								</form>
							</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>

		@yield('content')
	</div>

</body>
</html>
