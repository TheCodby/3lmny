@section('navbar')
@php
	@$available_locales  = Config::get('app.locales');
@endphp
<nav class="navbar navbar-custom navbar-light navbar-expand-md shadow-sm p-3 mb-5" id='navbar'>
		<div class="container-fluid">
			<a class="navbar-brand" href="{{route('index')}}">{{ __('titles.3lmny') }}</a>
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
				<span class="fas fa-bars"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarContent">
				<ul class="navbar-nav ms-auto">
						<li class="nav-item ms-1 mt-1 mt-md-0"><a type="button" href="{{ route('materials') }}" class="btn btn-outline-primary navbar-btn menu-item"><i data-feather="book" stroke-width='2' width='20px' height='20px'></i> {{ ucfirst(__('buttons.materials')) }}</a></li>
						@guest
							<li class="nav-item ms-1 mt-1 mt-md-0"><a type="button" class="btn btn-primary navbar-btn menu-item" href="{{ route('login') }}"><i data-feather="user" stroke-width='2' width='20px' height='20px'></i> {{ ucfirst(__('buttons.login')) }}</a></li>
						@endguest
					@auth
						<li class="nav-item ms-1 mt-1 mt-md-0"><a type="button" class="btn btn-gold navbar-btn menu-item"><i data-feather="dollar-sign" stroke-width='2' width='20px' height='20px'></i> {{ ucfirst(__('buttons.donate')) }}</a></li>
						<li class='nav-item ms-1 mt-1 mt-md-0'><div class="dropdown">
						<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
							<i data-feather="user"></i> {{ Auth::user()->username }}
						</a>
						@if(app()->getLocale() == 'ar')
							<ul class="dropdown-menu" style="position:absolute;" aria-labelledby="dropdownMenuLink">
						@else
							<ul class="dropdown-menu dropdown-menu-end" style="position:absolute;" aria-labelledby="dropdownMenuLink">
						@endif
							<li><a class="dropdown-item" href="{{route('myprofile')}}">Profile</a></li>
							<li><a class="dropdown-item" href="#">Settings</a></li>
							<li><a class="dropdown-item" href="{{route('materials.bookmarks')}}">Bookmarks</a></li>
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
@show