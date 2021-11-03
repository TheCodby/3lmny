@extends('templates.layout')

@section('title', __('titles.materials'))

@section('content')
	<div class='container position:relative;'>
		<div class="row">
			<div class='col-sm-4'>
				<div class="card shadow mb-3 sticky-top">
					<div class='card-header'><h3 class="card-title"><i class="fas fa-search"></i> Search</h3></div>
					<div class="card-body ">
					<form method='POST' action="{{ route('materials') }}" >
						<div class='form-group row'>
							<div class="col-sm-8">
								<label for="basic-url" class="form-label">Subject</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-sm-4">
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
							<div class="col-sm-6">
								<label for="basic-url" class="form-label">Level</label>
								<select class="form-select" aria-label="All">
									<option selected>All</option>
										@foreach($levels as $level)
											<option value="{{$level->id}}">{{$level->name}}</option>
										@endforeach
								</select>
							</div>
							<div class="col-sm-6">
								<label for="basic-url" class="form-label">Keywords</label>
								<input type="text" id="keywords" class="form-control">
							</div>
						</div>
						<button type='submit' class="btn btn-primary mt-2"><i class="fas fa-search"></i> Search</button>
					</form>
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				@foreach ($materials as $material)
					<div class="row mb-3">
						<div class="col-sm-12 mx-auto">
								<div class="card rounded shadow card-hover custom-card">
								<div class="row g-0">
									<div class="col-md-4">
										<img src="{{asset('images/materials/1.jpeg')}}" class="img-fluid h-100">
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
										<p class="card-text"><small class="text-muted">Last Updated {{$material->updated}}</small></p>
										<a href="#" class="stretched-link float-end"></a>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
				<div class="row mb-3">
					<nav aria-label="Page navigation example">
						<ul class="pagination d-flex justify-content-center">
							<li class="page-item"><a class="page-link" href="#">Previous</a></li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item"><a class="page-link" href="#">Next</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
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