<div class='row align-items-center'>
	<div class='col-sm-6 mx-auto'>
		<div class='card'>
			<div class='card-header'>
				<h3>Filters</h3>
			</div>
				<div class='card-body'>
					<form method='POST' action='{{route("admin.materials.search")}}'>
						@csrf
						<div class='form-group row'>
							<div class="col-8">
								<label for="basic-url" class="form-label">Subject</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-4">
								<label for="basic-url" class="form-label">Type</label>
								<select class="form-select" aria-label="All">
								  <option selected>Choose type</option>
								  @foreach($types as $type)
									<option value="{{$type->id}}">{{$type->name}}</option>
								@endforeach
								</select>
							</div>
						</div>
						<div class='form-group row'>
							<div class="col-6">
								<label for="basic-url" class="form-label">Level</label>
								<select class="form-select" aria-label="All">
								  	<option selected>All</option>
									@foreach($levels as $level)
										<option value="{{$level->id}}">{{$level->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-6">
								<label for="basic-url" class="form-label">Keywords</label>
								<input type="text" name='keywords' id="keywords" class="form-control">
							</div>
						</div>
						
				</div>
				<div class='card-footer d-flex justify-content-center'><button type='submit' class="btn btn-primary"><i class="fas fa-search"></i> Search</button></div>
			</form>
		</div>
	</div>
</div>
<script>
	$(document).ready( function() {
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
<div class='d-flex justify-content-center mt-2 mb-2'>
		<button type='button' class='btn btn-outline-Primary btn-md' data-bs-toggle="modal" data-bs-target="#addMaterial"><i class="fas fa-plus"></i> Add Material</button>
		<button type='button' class='btn btn-outline-Primary btn-md ms-1' data-bs-toggle="modal" data-bs-target="#showTypes"><i class="fas fa-clipboard-list"></i> Show types</button>
		<button type='button' class='btn btn-outline-Primary btn-md ms-1' data-bs-toggle="modal" data-bs-target="#showLevels"><i class="fas fa-user-graduate"></i> Show levels</button>
		<a class='btn btn-outline-Primary btn-md ms-1'><i class="fas fa-paper-plane"></i> Show requests</a>
</div>
@include('admin.materials.add')
@include('admin.materials.types')
@include('admin.materials.levels')
<div class="table-scrollable">
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Subject</th>
				<th scope="col">Keywords</th>
				<th scope="col">Created At</th>
				<th scope="col">Updated At</th>
				<th scope="col">Edit</th>
				<th scope="col">Delete</th>
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
					<td><a href='{{route("admin.materials.edit", $material->id)}}' class='btn btn-outline-success'>Edit</a></td>
					<td><a href='{{route("admin.materials.delete", $material->id)}}' class='btn btn-outline-danger'>Delete</a></td>
				</tr>
			@endforeach
		</tbody>
	</table>
</div>