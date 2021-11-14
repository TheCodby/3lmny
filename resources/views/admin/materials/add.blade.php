<div class="modal fade" id="addMaterial" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<form method='POST' action='{{route("admin.materials.add")}}' enctype="multipart/form-data">
		@csrf
		<div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Add Material</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			  </div>
			  <div class="modal-body">
				<div class='form-group row'>
						<div class="col-8">
							<label for="subject" class="form-label">Subject</label>
							<input type="text" name='subject' id='subject' class="form-control">
						</div>
						<div class="col-4">
							<label for="type" class="form-label">Type</label>
							<select name='type' id='type' class="form-select" aria-label="All">
							  <option selected>Choose Type</option>
							  @foreach($types as $type)
							  	<option value="{{$type->id}}">{{$type->name}}</option>
							  @endforeach
							</select>
						</div>
					</div>
					<div class='form-group row'>
						<div class="col-6">
							<label for="level" class="form-label">Level</label>
							<select name='level' id='level' class="form-select" aria-label="All">
							  <option selected>All</option>
							  @foreach($levels as $level)
							  	<option value="{{$level->id}}">{{$level->name}}</option>
							  @endforeach
							</select>
						</div>
						<div class="col-6">
							<label for="keywords2" class="form-label">Keywords</label>
							<input type="text" name='keywords' id="keywords2" class="form-control">
						</div>
						<div class="form-group row">
							<div class="col-12">
								<label for="basic-url" class="form-label">URL</label>
								<input type="text" name='url' id='url' class="form-control">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-12">
								<label for="basic-url" class="form-label">Description</label>
								<textarea class="form-control" name='description' id='description' placeholder="Leave a description here" id="floatingTextarea2" style="height: 100px"></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-12">
								<label for="formFile" class="form-label">Images</label>
								<input class="form-control" name='image' type="file" id="formFile">
							</div>
						</div>
					</div>
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type='submit' class="btn btn-primary mt-2">Add</button>
			  </div>
			</div>
		  </div>					
	</form>
</div>
<script>
	$(document).ready( function() {
		$('#keywords2').tagsInput();
	});
</script>
