@extends('templates.layout')

@section('title', __('titles.materials'))

@section('content')
	<div class='container'>
		<div class="row">
			<div class='col-sm-4'>
				<div class="card shadow mb-3 sticky-top">
					<div class='card-header'><h3 class="card-title"><i data-feather="search" stroke-width='2'></i> Filters</h3></div>
					<div class="card-body ">
						<div class='form-group row'>
							<div class="col-lg-8">
								<label for="basic-url" class="form-label">Subject</label>
								<input type="text" id='subject' name='subject' class="form-control">
							</div>
							<div class="col-lg-4">
								<label for="basic-url" class="form-label">Type</label>
								<select class="form-select" id='type' name='type' aria-label="All">
									<option value='all' selected>All</option>
									@foreach($types as $type)
										<option value="{{$type->id}}">{{$type->name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class='form-group row'>
							<div class="col-lg-6">
								<label for="basic-url" class="form-label">Level</label>
								<select class="form-select" id='level' name='level' aria-label="All">
									<option value='all' selected>All</option>
										@foreach($levels as $level)
											<option value="{{$level->id}}">{{$level->name}}</option>
										@endforeach
								</select>
							</div>
							<div class="col-lg-6">
								<label for="basic-url" class="form-label">Keywords</label>
								<input type="text" name='keywords' id="keywords" class="form-control">
							</div>
						</div>
						<button type='submit' id='search' class="btn btn-primary mt-2"><i class="fas fa-search"></i> Search</button>
					</div>
				</div>
			</div>
			<div class="col-sm-8" id='materialsData'>
				<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span> </div> </div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready( function() {
			$('#keywords').tagsInput();
			//Load first items
			$.ajax({
				url:"/Materials/Fetch?page=1",
				success:function(response)
				{
					replaceData(response);
				}
			})
			// Ajax for pages
			$(document).on('click', '.page-link', function(event){
				event.preventDefault();
				var page = $(this).attr('href').split('page=')[1];
				var url = "/Materials/Fetch?page="+page
				if(isSearch){
					var subject = $('#subject').val();
					var type = $('#type').val();
					var level = $('#level').val();
					var keywords = $('#keywords').val();
					url = "/Materials/Filter?subject="+subject+'&type='+type+'&level='+level+'&keywords='+keywords+'&page='+page;
				}
				fetch_page(url);
			})
			function fetch_page(url)
			{
				$("#materialsData").html('<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span> </div> </div>');
				$.ajax({
					url:url,
					success:function(response)
					{
						replaceData(response);
					}
				})
			}
			// Ajax for search
			$(document).on('click', '#search', function(event){
				event.preventDefault();
				var subject = $('#subject').val();
				var type = $('#type').val();
				var level = $('#level').val();
				var keywords = $('#keywords').val();
				var data = '?subject='+subject+'&type='+type+'&level='+level+'&keywords='+keywords
				filter(data);
			})
			function filter(data)
			{
				$("#materialsData").html('<div class="d-flex justify-content-center"> <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="visually-hidden">Loading...</span> </div> </div>');
				$.ajax({
					type : 'GET',
					url:"/Materials/Filter"+data,
					success:function(response)
					{
						replaceData(response);
					}
				})
			}
			function replaceData(data)
			{
				$( "#materialsData" ).css("opacity", "0");
				$('#materialsData').html(data);
				$( "#materialsData" ).animate({
					opacity: 1,
				}, 1000, function() {
					// Animation complete.
				});
			}
		});
	</script>
@endsection