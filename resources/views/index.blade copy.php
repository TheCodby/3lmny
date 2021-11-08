@extends('templates.layout')

@section('title', __('titles.main'))

@section('content')
	<script src="https://cdn.jsdelivr.net/npm/typed.js@latest/lib/typed.min.js"></script>
	<div id="carouselExampleSlidesOnly" class="carousel slide mb-3" data-bs-ride="carousel">
	  <div class="carousel-inner">
		<div class="carousel-item active">
			<img src="{{ asset('images/edu.jpg') }}" class="w-100" style="transform: scale(1.1);" data-speed="-1" id='carousel' />
			<div class="carousel-caption" style="top: 50%; transform: translateY(-50%);">
				<h2 id='typing'></h2>
				@guest
					<a type="button" class="btn btn-success btn-lg" href="{{ route('register') }}">{{ __('buttons.joinnow') }}</a>
				@endguest
			</div>
		</div>
	  </div>
	</div>
	<div class='container mb-4'>
		<div class='card'>
			<div class='card-body'>
				<h3 class='card-title'>Last Sources</h3>
				<div class='card-content'></div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			$( "#navbar" ).removeClass( "mb-5" );
			//
			var txt = "{{ __('messages.greeting') }}";
			var i = 0;
			var speed = 100;
			
			function typingEffect(eleID, txt)
			{
				if (i < txt.length)
				{
					document.getElementById(eleID).innerHTML += txt.charAt(i);
					i++;
					setTimeout(typingEffect, speed, eleID, txt)
				}
			}
			typingEffect('typing', txt)
		});
	</script>
@endsection