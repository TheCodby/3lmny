@extends('templates.layout')

@section('title', $user->username)

@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success d-flex align-items-center mb-3" role="alert">
                <div>
                {{ session()->get('message') }}
                </div>
            </div>
        @endif
        @if(!$errors->isEmpty())
        <div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
            <div>
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            </div>
        </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header fs-4">Profile</div>
                    <div class="card-body">
                        <p class="card-text">Welcome To Profile</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
		$(document).ready( function() {
			$('#interests').tagsInput();
		});
	</script>
@endsection