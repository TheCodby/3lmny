@extends('templates.layout')

@section('title', __('titles.materials'))

@section('content')
	<div class='container'>
		<div class='row mb-3'>
			<div class='col'>
				<div class="card shadow">
					<div class='card-header'><h3 class="card-title">Search</h3></div>
					<div class="card-body">
					<p class="card-text">Please fill these fields to find best sources that help you to studying better.</p>
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
								  <option value="1">Math</option>
								  <option value="2">Physics</option>
								  <option value="3">English</option>
								</select>
							</div>
						</div>
						<div class='form-group row'>
							<div class="col-3">
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
		<div class="row mb-3 align-items-center">
			<div class="col-8 mx-auto">
				<div class="card shadow">
					<div class="card-header"><h3 class="card-title">Materials</h3></div>
					<table class="card-body table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Subject</th>
								<th scope="col">Keywords</th>
								<th scope="col">Created At</th>
								<th scope="col">Updated At</th>
								<th scope="col">Show</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($materials as $material)
								<tr>
									<th scope="row">{{$material->id}}</th>
									<td>{{$material->subject}}</td>
									@php
										@$keywords = json_decode($material->keywords)
									@endphp
									<td>
									@foreach ($keywords as $keyword)
										<span class="badge rounded-pill bg-primary">{{$keyword}}</span>
									@endforeach
									</td>
									<td>{{$material->created_at}}</td>
									<td>{{$material->updated_at}}</td>
									<td><a href='{{route("materials.show", $material->id)}}' class='btn btn-outline-success'>Show</a></td>
								</tr>
							@endforeach
						</tbody>
					</table>
					<div class="align-self-center">
						<nav aria-label="Page navigation example">
							<ul class="pagination">
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