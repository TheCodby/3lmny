<div class='row align-items-center'>
	<div class='col-sm-6 mx-auto'>
		<div class='card'>
			<div class='card-header'>
				<h3>Filters</h3>
			</div>
				<div class='card-body'>
					<div class='form-group row'>
						<div class="col-8">
							<label for="basic-url" class="form-label">Subject</label>
							<input type="text" id='subjectSearch' class="form-control">
						</div>
						<div class="col-4">
							<label for="basic-url" class="form-label">Type</label>
							<select class="form-select" id='typeSearch' aria-label="All">
								<option value='all' selected>All</option>
								@foreach($types as $type)
								<option value="{{$type->id}}">{{$type->name}}</option>
							@endforeach
							</select>
						</div>
					</div>
					<div class='form-group row'>
						<div class="col-6">
							<label for="basic-url" class="form-label">Level</label>
							<select class="form-select" id='levelSearch' aria-label="All">
								<option value='all' selected>All</option>
								@foreach($levels as $level)
									<option value="{{$level->id}}">{{$level->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="col-6">
							<label for="basic-url" class="form-label">Keywords</label>
							<input type="text" name='keywords' id="keywordsSearch" class="form-control">
						</div>
					</div>
				</div>
				<div class='card-footer d-flex justify-content-center'><button type='submit' id='searchMaterials' class="btn btn-primary"><i class="fas fa-search"></i> Search</button></div>
		</div>
	</div>
</div>
<div class='d-flex justify-content-center mt-2 mb-2'>
		<button type='button' class='btn btn-outline-Primary btn-md' data-bs-toggle="modal" data-bs-target="#addMaterial"><i class="fas fa-plus"></i> Add Material</button>
		<button type='button' class='btn btn-outline-Primary btn-md ms-1' data-bs-toggle="modal" data-bs-target="#showTypes"><i class="fas fa-clipboard-list"></i> Show types</button>
		<button type='button' class='btn btn-outline-Primary btn-md ms-1' data-bs-toggle="modal" data-bs-target="#showLevels"><i class="fas fa-user-graduate"></i> Show levels</button>
		<button type='button' id='showRequests' class="btn btn-outline-Primary btn-md ms-1"><i class="fas fa-paper-plane"></i> Show requests</button>
</div>
@include('admin.materials.add')
@include('admin.materials.types')
@include('admin.materials.levels')
<div id="materialsData"></div>
<script>
	var showRequests = false;
	$(document).ready(function(){
		$('#keywordsSearch').tagsInput();
		$.ajax({
			url:"/Admin/Materials/Fetch?Page=1",
			success:function(data)
			{
				$('#materialsData').html(data);
			}
		})
		// Ajax for pages
		$(document).on('click', '.page-link', function(event){
			event.preventDefault();
			var page = $(this).attr('href').split('Page=')[1];
			var url = "/Admin/Materials/Fetch?Page="+page
			if(isSearch){
				var subject = $('#subjectSearch').val();
				var type = $('#typeSearch').val();
				var level = $('#levelSearch').val();
				var keywords = $('#keywordsSearch').val();
				url = "/Admin/Materials/Filter?subject="+subject+'&type='+type+'&level='+level+'&keywords='+keywords+'&Page='+page;
			}
			fetch_page(url);
		})
		function fetch_page(url)
		{
			$("#materialsData").html('<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span> </div> </div>');
			$.ajax({
				url:url,
				success:function(data)
				{
					$('#materialsData').html(data);
				}
			})
		}
		// Ajax for search
		$(document).on('click', '#searchMaterials', function(event){
			event.preventDefault();
			var subject = $('#subjectSearch').val();
			var type = $('#typeSearch').val();
			var level = $('#levelSearch').val();
			var keywords = $('#keywordsSearch').val();
			var data = '?subject='+subject+'&type='+type+'&level='+level+'&keywords='+keywords
			filter(data);
		})
		function filter(data)
		{
			$("#materialsData").html('<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span> </div> </div>');
			$.ajax({
				type : 'GET',
				url:"/Admin/Materials/Filter"+data,
				success:function(response)
				{
					$('#materialsData').html(response);
				}
			})
		}
		$(document).on('click', '#showRequests', function(event){
			event.preventDefault();
			if(showRequests){
				$("#materialsData").html('<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span> </div> </div>');
				$.ajax({
					url:"/Admin/Materials/Fetch?Page=1",
					success:function(data)
					{
						$('#materialsData').html(data);
						$('#showRequests').html('<i class="fas fa-paper-plane"></i> Show Requests');
						showRequests = false;
					}
				})
			}else{
				var url = "/Admin/Materials/Requests?Page=1"
				$("#materialsData").html('<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span> </div> </div>');
				$.ajax({
					url:url,
					success:function(data)
					{
						$('#materialsData').html(data);
						$('#showRequests').html('Hide Requests');
						showRequests = true;
					}
				})
			}
		})
	});
</script>