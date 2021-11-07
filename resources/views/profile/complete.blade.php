@extends('templates.layout')

@section('title', __('titles.completeprofile'))

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
            <div class="col-8">
                <div class="card">
                    <div class="card-header fs-4">Complete Your Profile</div>
                    <div class="card-body">
                        <p class="card-text">Please fill these fields to give you better recommends</p>
                        <form method='POST' action='{{route("profile.complete")}}'>
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name='age' aria-label="">
                                            <option selected>{{$user->age ?? 'Choose your age'}}</option>
                                            @for ($i = 6; $i <= 60; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <label for="floatingSelect">Your Age</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" name='level' aria-label="">
                                            <option selected>{{$user->level ?? 'Choose your level'}}</option>
                                            @foreach ($levels as $level)
                                            <option value="{{$level->id}}">{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                        <label for="floatingSelect">Your Level</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <input type="text" name='major' value='{{$user->major}}' class="form-control" id="floatingInputGrid" placeholder="Computer Science, Math, English">
                                        <label for="floatingInputGrid">Your Major</label>
                                    </div>
                                </div>
                            </div>
                            <button type='submit' class='btn btn-primary mt-2'>Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection