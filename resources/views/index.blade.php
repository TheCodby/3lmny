@include('templates.header')
@php
	@$available_locales  = Config::get('app.locales');
@endphp
	<script src="https://cdn.jsdelivr.net/npm/typed.js@latest/lib/typed.min.js"></script>
	<div id="carouselExampleSlidesOnly" class="carousel slide mb-3" data-bs-ride="carousel" style='position:relative;'>
	  <div class="carousel-inner">
		<div class="carousel-item active h-100" style='background-color:24a0ed;'>
		<nav class="navbar navbar-expand-md" id='navbar' style='direction: ltr;'>
			<div class="container-fluid">
				<a class="navbar-brand fs-4 text-light" href="{{route('index')}}">{{ __('titles.3lmny') }}</a>
				<ul class="navbar-nav me-auto">
						<li class="nav-item">
							<ul class="navbar-nav">
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
							</ul>
						</li>
					</ul>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarContent">
					<ul class="navbar-nav index ms-auto">
							<li class="nav-item ms-3 mt-2 mt-md-0 fs-6"><a type="button" href="{{ route('materials') }}" class="navbar-btn menu-item text-light"> {{ ucfirst(__('buttons.materials')) }}</a></li>
							@guest
								<li class="nav-item ms-3 mt-2 mt-md-0 fs-6"><a type="button" class="menu-item text-light" href="{{ route('login') }}"> {{ ucfirst(__('buttons.login')) }}</a></li>
							@endguest
						@auth
							<li class="nav-item ms-3 mt-2 mt-md-0 fs-6"><a type="button" href="#" class="navbar-btn menu-item text-light"> {{ ucfirst(__('buttons.donate')) }}</a></li>
							<li class='nav-item ms-3 mt-2 mt-md-0 fs-6'><div class="dropdown">
							<a class="text-light" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fas fa-user-circle"></i> {{ Auth::user()->username }}
							</a>
							@if(app()->getLocale() == 'ar')
								<ul class="dropdown-menu dropstart" aria-labelledby="dropdownMenuLink">
							@else
								<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
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
							</div>
						</li>
						@endauth
					</ul>
				</div>
			</div>
		</nav>
			<div class="caption ms-4">
				<div class='me-5'>
					<h2 id='typing' class='text-light'></h2>
					@guest
						<a type="button" class="btn btn-success btn-lg" href="{{ route('register') }}">{{ __('buttons.joinnow') }}</a>
					@endguest
				</div>
			</div>
		</div>
	  </div>
	  	<div class="wave">
			<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
				<path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
				<path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
				<path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
			</svg>
		</div>
	</div>
	<div class='container mb-4'>
		
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
@include('templates.footer')