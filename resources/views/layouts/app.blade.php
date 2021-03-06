<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Hotel Costa rica</title>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ asset('plugin/fontawesome/css/fontawesome-all.css') }}">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<div>
		<header>
			@guest
				<nav class="navbar navbar-expand-md navbar-laravel navbar-light">
			@else
				<nav class="navbar navbar-expand-md bg-primary navbar-dark">
			@endguest
				<div class="container">
					<a class="navbar-brand" href="{{ url('/') }}">
						Hotel Costa rica
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<!-- Left Side Of Navbar -->
						<ul class="navbar-nav mr-auto">

						</ul>

						<!-- Right Side Of Navbar -->
						<ul class="navbar-nav ml-auto">
							<!-- Authentication Links -->
							@guest
								{{-- <li><a class="nav-link" href="{{ route('login') }}"></a></li> --}}
								{{-- <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li> --}}
							@else
								<li class="nav-item dropdown">
									<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
										{{ Auth::user()->name }} <span class="caret"></span>
									</a>

									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="{{ route('logout') }}"
										   onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
											Salir
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
			@guest

			@else
			<nav class="navbar-light navbar-laravel">
				<div class="container">
					<ul class="nav justify-content-center">
					  {{-- <li class="nav-item">
						<a class="nav-link active" href="#">
							<i class="fa fa-home"></i>
							Inicio
						</a>
					  </li> --}}
					  <li class="nav-item">
						<a class="nav-link" href="{{route('room.index')}}">
							<i class="fa fa-door-open"></i>
							Habitaciones
						</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="{{route('user.index')}}">
							<i class="fa fa-user"></i>
							Clientes
						</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="{{route('reservation.index')}}">
							<i class="fa fa-book"></i>
							Reservas
						</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" href="{{url('/statistics')}}">
							<i class="fa fa-chart-line"></i>
							Estadisticas
						</a>
					  </li>
					  {{-- <li class="nav-item">
						<a class="nav-link" href="#">
							<i class="fa fa-cog"></i>
							Configuración
						</a>
					  </li> --}}
					</ul>
				</div>
			</nav>
			@endguest
		</header>
		<main class="py-4">
			<div class="container">
				@yield('content')
			</div>
		</main>
	</div>
</body>
</html>
