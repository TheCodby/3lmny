@extends('templates.layout')

@section('title', __('titles.materials'))

@section('content')
	<div class='container'>
		<div class='row mb-5'>
			<div class='col'>
				<div class="card shadow">
					<div class='card-header'><h3 class="card-title"><i class="fas fa-search"></i> Search</h3></div>
					<div class="card-body ">
					<form method='POST' action="{{ route('materials') }}" >
						<div class='form-group row'>
							<div class="col-6">
								<label for="basic-url" class="form-label">Subject</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-3">
								<label for="basic-url" class="form-label">Type</label>
								<select class="form-select" aria-label="All">
								  <option selected>All</option>
								  	@foreach($types as $type)
										<option value="{{$type->id}}">{{$type->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class='form-group row'>
							<div class="col-sm-3">
								<label for="basic-url" class="form-label">Your level</label>
								<select class="form-select" aria-label="All">
								  <option selected>Empty</option>
								  <option value="1">Primary education</option>
								  <option value="2">Middle education</option>
								  <option value="3">High school</option>
								  <option value="4">College education</option>
								</select>
							</div>
							<div class="col-6">
								<label for="basic-url" class="form-label">Keywords</label>
								<input type="text" id="keywords" class="form-control">
							</div>
						</div>
						<button type='submit' class="btn btn-primary mt-2"><i class="fas fa-search"></i> Search</button>
					</form>
				  </div>
				</div>
			</div>
		</div>
		@foreach ($materials as $material)
			<div class="row mb-3 align-items-center">
				<div class="col-sm-10 mx-auto">
						<div class="card shadow card-hover">
						<div class="row g-0">
							<div class="col-md-4">
							<img src="{{asset('images/materials/1.jpeg')}}" class="img-fluid h-100" style='border-radius: 30px 0px 0px 30px;'>
							</div>
							<div class="col-md-8">
							<div class="card-body">
								<h5 class="card-title">{{$material->subject}}</h5>
								@php
									@$keywords = json_decode($material->keywords)
								@endphp
								@foreach ($keywords as $keyword)
									<p class="badge rounded-pill bg-primary">{{$keyword}}</p>
								@endforeach
								<p>Type: {{$material->materialTypes->name}}</p>
								<p class="card-text">{{$material->description}}</p>
								<p class="card-text"><small class="text-muted">{{$material->updated}}</small></p>
								<a href="#" class="stretched-link float-end"></a>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
	<script>
		$(document).ready( function() {
			var keywords = [];
			$('#keywords').tagsInput();
			$('#keywords').tagsInput({
				'onAddTag': function(input, value) {
					console.log('tag added', input, value);
				},
				'onRemoveTag': function(input, value) {
					console.log('tag removed', input, value);
				},
				'onChange': function(input, value) {
					console.log('change triggered', input, value);
				}
			});
		});
	</script>
@endsection