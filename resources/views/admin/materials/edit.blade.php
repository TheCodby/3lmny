@extends('templates.layout')

@section('title', $material->subject)

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 order-md-1">
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
                <div class="card mb-3">
                    <div class="card-header fs-4">@if(isset($materialRequest)) Material Request @else Edit Material @endif #{{$material->id}}</div>
                    <div class="card-body">
                        @if(isset($user))
                            <p class="card-text">Requested by <a href="{{route('profile', $user->id)}}">#{{$user->id}} {{$user->username}}</a></p>
                        @endif
                        <form method='POST' action="@if(isset($materialRequest)) {{route('material.request.publish', $material->id)}} @else {{route('admin.materials.edit', $material->id)}} @endif" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="subject" class="form-label">Subject</label>
                                        <input type="text" name='subject' value='{{$material->subject}}' class="form-control" id="subject">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="subject" class="form-label">Type</label>
                                        <select class="form-select" id="type" name='type' aria-label="">
                                            <option value="{{$material->type}}" selected>{{$material->typeRow->name ?? 'Choose Type'}}</option>
                                            @foreach($types as $type)
                                                @if($type->id != $material->type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="url" class="form-label">URL</label>
                                        <input type="url" name='url' value='{{$material->url}}' class="form-control" id="url">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="subject" class="form-label">Level</label>
                                        <select class="form-select" id="level" name='level' aria-label="">
                                            <option value="{{$material->level}}" selected>{{$material->levelRow->name ?? 'Choose Type'}}</option>
                                            @foreach($levels as $level)
                                                @if($level->id != $material->level)
                                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="keywords" class="form-label">Keywords</label>
                                        <input type="text" value='{{$material->keywords}}' name='keywords' id="keywords" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="subject" class="form-label">Description</label>
                                        <textarea class="form-control" name='description' id='description' placeholder="Leave a description here" id="floatingTextarea2" style="height: 150px">{{$material->description}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="formFile" class="form-label">Image</label>
                                        <input class="form-control" name='image' type="file" id="formFile">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                    @if(isset($materialRequest))
                                        <button type='submit' class="btn btn-success mx-1">Publish</button>
                                        <a href='{{route("material.request.delete", $material->id)}}' class='btn btn-outline-danger'>Delete</a>
                                    @else
                                        <button type='submit' class="btn btn-primary">Edit</button>
                                    @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 order-md-2">
                <img src="{{asset('storage/uploads/materials/'.$material->image->path) ?? ''}}" class="img-fluid hoverimage" style='border-radius:30px;'>
            </div>
        </div>
    </div>
    <script>
		$(document).ready( function() {
			$('#keywords').tagsInput();
		});
	</script>
@endsection