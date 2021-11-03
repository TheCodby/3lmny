@section('header')
@php
	@$available_locales  = Config::get('app.locales');
@endphp
	@if(app()->getLocale() == 'ar')
		<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
	@else
		<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	@endif
		<head>
			<title>{{ __('titles.3lmny') }} - @yield('title')</title>
			<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
			<script src="https://kit.fontawesome.com/ba6d6c4c2b.js" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="css/jquery_tagsinput.css">
			<meta name="csrf-token" content="{{ csrf_token() }}">
		</head>
	<body>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
	<script src="js/jquery_tagsinput.js"></script>
	<nav class="navbar navbar-custom navbar-light navbar-expand-lg shadow-sm p-3 mb-5" id='navbar'>
		<div class="container-fluid">
			<ul class='nav navbar-nav' style="display:inline-block;">
				<li class="nav-item"><a class="navbar-brand" href="{{ route('index') }}">
					<!-- <img src="https://seeklogo.com/images/L/logo-com-hr-logo-5636A4D2D5-seeklogo.com.png" alt="" width="50" height="50" class="d-inline-block align-text-top" /> -->
					{{ __('titles.3lmny') }}
				</a></li>
				<li class="nav-item"><ul class="navbar-nav">
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<span class="flag-icon flag-icon-{{$available_locales[Config::get('app.locale')][1]}}"></span>
					  </a>
					  <ul class="dropdown-menu" style="min-width:inherit;position:absolute;" aria-labelledby="navbarDropdown">
						@foreach ($available_locales as $locales)
							@if(Config::get('app.locale') != $locales[0])
								<li><a class="dropdown-item" href="{{ route('lang', $locales[0]) }}"> {{$locales[2]}} <span class="flag-icon flag-icon-{{$locales[1]}}"></span></a></li>
							@endif
						@endforeach
					  </ul>
					</li>
				</ul></li>
			</ul>
			<ul class='nav navbar-nav d-flex flex-row-reverse' style="display:inline-block;">
				@auth
					<li class='nav-item'><div class="dropdown">
					  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fas fa-user-circle"></i> {{ Auth::user()->username }}
					  </a>
					@if(app()->getLocale() == 'ar')
						<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
					@else
						<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
					@endif
						<li><a class="dropdown-item" href="#">Account</a></li>
						<li><a class="dropdown-item" href="#">Settings</a></li>
						<li><a class="dropdown-item" href="#">Bookmarks</a></li>
						@if(Auth::user()->user_type == '2')
						<li><a class="dropdown-item" href="{{route('admin')}}">Admin Panel</a></li>
						@endif
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="{{route('logout')}}">{{ucfirst(__('buttons.logout'))}}</a></li>
						
					  </ul>
					</div></li>
				@endauth
				@guest
					<li class="nav-item"><a type="button" class="btn btn-primary navbar-btn menu-item" href="{{ route('login') }}"><i class="fas fa-user"></i> {{ ucfirst(__('buttons.login')) }}</a></li>
				@endguest
				<li class="nav-item"><a type="button" href="{{ route('materials') }}" class="btn btn-outline-primary navbar-btn menu-item d-none d-sm-block"><i class="fas fa-search"></i> {{ ucfirst(__('buttons.browse')) }}</a></li>
				<li class="nav-item"><a type="button" class="btn btn-gold navbar-btn menu-item d-none d-sm-block"><i class="fas fa-hand-holding-usd"></i> {{ ucfirst(__('buttons.donate')) }}</a></li>
			</ul>
		</div>
	</nav>
@show