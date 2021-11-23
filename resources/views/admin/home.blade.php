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
					<button class="nav-link disabled" id="analysis-tab" data-bs-toggle="tab" data-bs-target="#analysis" type="button" role="tab" aria-controls="analysis" aria-selected="true"><i class="fas fa-chart-line"></i> Analysis <p class="badge rounded-pill bg-danger mb-0">Soon!</p></button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link active" id="materials-tab" data-bs-toggle="tab" data-bs-target="#materials" type="button" role="tab" aria-controls="materials" aria-selected="true"><i class="fas fa-book"></i> Materials @if($notifications['materials_requests'] > 0)<span class="badge bg-primary rounded-pill">{{$notifications['materials_requests']}}</span>@endif</button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true"><i class="fas fa-users"></i> Users</button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link" id="contacts-tab" data-bs-toggle="tab" data-bs-target="#contacts" type="button" role="tab" aria-controls="contacts" aria-selected="true"><i class="fas fa-brain"></i> Contacts @if($notifications['contacts'] > 0)<span class="badge bg-primary rounded-pill">{{$notifications['contacts']}}</span>@endif</button>
				  </li>
				</ul>
				<div class='card-body'>
					<div class="tab-content" id="tabContent">
						<div class="tab-pane" id="analysis" role="tabpanel" aria-labelledby="analysis-tab">
							
						</div>
						<div class="tab-pane show active" id="materials" role="tabpanel" aria-labelledby="materials-tab">
							@include('admin.materials')
						</div>
						<div class="tab-pane" id="users" role="tabpanel" aria-labelledby="users-tab">
						@include('admin.users')
						</div>
						<div class="tab-pane" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
							@include('admin.contacts')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection