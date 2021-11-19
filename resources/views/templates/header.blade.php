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
			<script src="https://unpkg.com/feather-icons"></script>
			<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
			<link href="{{ asset('css/jquery_tagsinput.css') }}" rel="stylesheet" type="text/css" >
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
			<meta name="csrf-token" content="{{ csrf_token() }}">
			<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		</head>
	<body>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
	<script src="{{asset('js/jquery_tagsinput.js')}}"></script>
@show