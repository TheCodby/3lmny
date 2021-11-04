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
							<div class="col-lg-8">
								<label for="basic-url" class="form-label">Subject</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-lg-4">
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
							<div class="col-lg-6">
								<label for="basic-url" class="form-label">Level</label>
								<select class="form-select" aria-label="All">
									<option selected>All</option>
										@foreach($levels as $level)
											<option value="{{$level->id}}">{{$level->name}}</option>
										@endforeach
								</select>
							</div>
							<div class="col-lg-6">
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
							<div class="card shadow card-hover custom-card">
							<img src="{{asset('images/materials/1.jpeg')}}" class="img-fluid card-img">
								<div class="card-body">
									<div class='ms-2'>
									<h5 class="card-title mb-0">{{$material->subject}}</h5>
									@php
										@$keywords = json_decode($material->keywords)
									@endphp
									@foreach ($keywords as $keyword)
										<p class="badge rounded-pill bg-primary mb-0">{{$keyword}}</p>
									@endforeach
									<p class='mb-0'>Type: {{$material->materialTypes->name}}</p>
									<p class='mb-0'>Level: {{$material->levelName->name}}</p>
									<p class="card-text mb-0 fs-6">{{mb_substr($material->description, 0, 50, 'utf-8')}}</p>
									<p class="card-text mb-0"><small class="text-muted">Last Updated {{$material->updated}}</small></p>
									<a href="#" class="stretched-link mb-0"></a>
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