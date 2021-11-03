@extends('templates.layout')

@section('title', __('titles.admin'))

@section('content')
	<div class='container'>
		<div class='row'>
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
			<div class='card p-2 mb-5'>
				<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
				  <li class="nav-item" role="presentation">
					<button class="nav-link active" id="analysis-tab" data-bs-toggle="tab" data-bs-target="#analysis" type="button" role="tab" aria-controls="analysis" aria-selected="true">Analysis</button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link" id="materials-tab" data-bs-toggle="tab" data-bs-target="#materials" type="button" role="tab" aria-controls="materials" aria-selected="true">Materials <span class="badge bg-primary rounded-pill">1</span></button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">Users <span class="badge bg-primary rounded-pill">1</span></button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link" id="suggestions-tab" data-bs-toggle="tab" data-bs-target="#suggestions" type="button" role="tab" aria-controls="suggestions" aria-selected="true">Suggestions <span class="badge bg-primary rounded-pill">1</span></button>
				  </li>
				</ul>
				<div class='card-body'>
					<div class="tab-content" id="tabContent">
						<div class="tab-pane fade show active" id="analysis" role="tabpanel" aria-labelledby="analysis-tab">
							
						</div>
						<div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="materials-tab">
							@include('admin.materials')
						</div>
						<div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
							
						</div>
						<div class="tab-pane fade" id="suggestions" role="tabpanel" aria-labelledby="suggestions-tab">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection