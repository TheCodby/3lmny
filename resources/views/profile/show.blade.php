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
            <div class="col-md-3 mb-3 order-md-2">
                <img src="{{asset('images/users/default.png')}}" class="img-fluid"  style='border-radius:30px'>
            </div>
            <div class="col-md-8 mb-3 order-md-1">
                <div class="card">
                    <div class="card-header fs-4">Profile</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <dl>
                                    <dt>Username</dt>
                                    <dd>{{$user->username}}</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl>
                                    <dt>Registered At</dt>
                                    <dd>{{$user->created_at}}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <dl>
                                    <dt>Interests</dt>
                                    @php
                                        @$interests = explode(",", $user->interests)
                                    @endphp
                                    @foreach ($interests as $interest)
                                        <dd class="badge rounded-pill bg-primary mb-0">{{$interest}}</dd>
                                    @endforeach
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl>
                                    <dt>Major</dt>
                                    <dd>{{$user->major  ?? ''}}</dd>
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <dl>
                                    <dt>Level</dt>
                                    <dd>{{$user->levelRow->name  ?? ''}} Student</dd>
                                </dl>
                            </div>
                            <div class="col-md-6">
                                <dl>
                                    <dt>Age</dt>
                                    <dd>{{$user->age ?? ''}}</dd>
                                </dl>
                            </div>
                        </div>
                        @if(Auth::id() == $user->id)
                            <div class="d-flex justify-content-end">
                                <a href="{{route('profile.edit')}}" class='btn btn-outline-primary'>Edit Your Profile</a>
                            </div>
                        @endif
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