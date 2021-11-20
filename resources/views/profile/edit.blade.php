@extends('templates.layout')

@section('title', __('titles.editprofile'))

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
        <div class="row ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header fs-4">Edit Your Profile</div>
                    <div class="card-body">
                        <form method='POST' action='{{route("profile.edit")}}'>
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="age" class="form-label">Your Age</label>
                                        <select class="form-select" id="age" name='age' aria-label="">
                                            <option selected>{{$user->age ?? 'Choose your age'}}</option>
                                            @for ($i = 6; $i <= 60; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="level" class="form-label">Your Level</label>
                                        <select class="form-select" id="level" name='level' aria-label="">
                                            <option value="{{$user->levelRow->id ?? 'None'}}" selected>{{$user->levelRow->name ?? 'None'}}</option>
                                            @php
                                                $userLevel = $user->levelRow->id ?? 0;
                                            @endphp
                                            @foreach ($levels as $level)
                                                @if($level->id != $userLevel)
                                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="major" class="form-label">Your Major</label>
                                        <input type="text" name='major' value='{{$user->major}}' class="form-control" id="major" placeholder="Computer Science, Math, English">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="interests" class="form-label">Your Interests</label>
                                    <input type="text" name='interests' id="interests" value='{{$user->interests}}' class="form-control">
                                </div>
                            </div>
                            <button type='submit' class='btn btn-primary mt-2'>Update</button>
                        </form>
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