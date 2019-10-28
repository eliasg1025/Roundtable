<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Roundtable') }}  | Conectamos compradores de todo el mundo con alimentos peruanos 100% orgánicos y ecológicos</title>

	<!-- Pusher.js -->
	<script src="https://js.pusher.com/5.0/pusher.min.js"></script>
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito|Roboto|Poppins" rel="stylesheet">
	<link rel="shortcut icon" href="/img/logo/favicon.png" type="image/x-icon">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/tiny-slider.css">
	<link rel="stylesheet" href="https://jaysalvat.github.io/vegas/releases/latest/vegas.min.css">
</head>
<body>
	<div id="app">
		<nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
			<div class="container">
				
				<a class="navbar-brand" href="{{ url('/') }}" style="font-family: 'Amatic SC', cursive; font-size:25px;">
					<img src="/img/logo/logopit.png" width="90" height="48" class="d-inline-block align-top" alt="">
				</a>
				
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>
					
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav mr-auto">
						<li class="nav-item mr-3">
							<a href="{{ route('business') }}" class="nav-link navbar-list__link">Empresas</a>
						</li>
						<li class="nav-item mr-3">
							<a href="{{ url('/planes') }}" class="nav-link navbar-list__link">Planes</a>
						</li>
						<li class="nav-item mr-3">
							<a href="{{url('/contact')}}" class="nav-link navbar-list__link">Contacto</a>
						</li>
					</ul>
					<!-- Center Side Of Navbar -->
					<a id="logo" href="{{ url('/') }}" class="logo-main" style="margin-left: -80px;">
						<span style="font-family: 'Amatic SC', cursive; font-size:25px;" class="logo-main-title d-none">Rountable</span>
						<img id="img-logo" src="/img/logo/logo-v3.png" class="img-fluid">
						<img id="img-small-logo" src="/img/logo/logopit.png" class="img-fluid" style="display: none;">
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
							<li class="nav-item dropdown dropdown-notifications">
								<!--
								<a class="nav-link navbar-list__link" href="#">
									<i class="fas fa-bell"></i>
								</a>-->
								<a id="notificationDropdown" href="#" role="button" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i data-count="0" class="notification-icon fas fa-bell" style="font-size: 16px;"></i>
								</a>

								<div class="dropdown-menu notification-menu-right" aria-labelledby="#notificationDropdown">
									<div class="dropdown-toolbar">
										<div class="dropdown-toolbar-actions" style="display: none;">
											<a href="#">Mark all as read</a>
										</div>
										<h5 class="dropdown-toolbar-title">Notificaciones (<span class="notif-count">0</span>)</h5>
									</div>
									<ul id="notification-list"></ul>
									<div class="dropdown-footer text-center">
										<a href="#">Ver todo</a>
									</div>
								</div>
							</li>
							<li class="nav-item dropdown">
								<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
									{{ Auth::user()->name }} <span class="caret"></span>
								</a>

								<div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="{{ route('profile') }}">
										{{ __('Ver perfil') }}
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('planes') }}">
										{{ __('Coins') }}
										<span class="badge badge-roundtable">{{ Auth::user()->coins }}</span>
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('logout') }}"
									onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
									>
										{{ __('Cerrar Sesión') }}
									</a>

									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
										@csrf
									</form>
								</div>
							</li>
						@endguest
					</ul>
				</div>
			</div>
		</nav>	
		@yield('content')
	</div>
	<!-- Zepto.js -->
	<script src="http://zeptojs.com/zepto.min.js"></script>
	<!-- Culqi.js -->
	<script src="https://checkout.culqi.com/v2"></script>
</body>
</html>
