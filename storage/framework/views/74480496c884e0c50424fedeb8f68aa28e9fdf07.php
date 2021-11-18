<div class='row align-items-center'>
	<div class='col-sm-6 mx-auto'>
		<div class='card'>
			<div class='card-header'>
				<h3>Filters</h3>
			</div>
				<div class='card-body'>
					<form method='POST' action='<?php echo e(route("admin.materials.search")); ?>'>
						<?php echo csrf_field(); ?>
						<div class='form-group row'>
							<div class="col-8">
								<label for="basic-url" class="form-label">Subject</label>
								<input type="text" id='subjectSearch' class="form-control">
							</div>
							<div class="col-4">
								<label for="basic-url" class="form-label">Type</label>
								<select class="form-select" id='typeSearch' aria-label="All">
								  <option value='all' selected>All</option>
								  <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<div class='form-group row'>
							<div class="col-6">
								<label for="basic-url" class="form-label">Level</label>
								<select class="form-select" id='levelSearch' aria-label="All">
								  	<option value='all' selected>All</option>
									<?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($level->id); ?>"><?php echo e($level->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
							<div class="col-6">
								<label for="basic-url" class="form-label">Keywords</label>
								<input type="text" name='keywords' id="keywordsSearch" class="form-control">
							</div>
						</div>
						
				</div>
				<div class='card-footer d-flex justify-content-center'><button type='submit' id='searchMaterials' class="btn btn-primary"><i class="fas fa-search"></i> Search</button></div>
			</form>
		</div>
	</div>
</div>
<div class='d-flex justify-content-center mt-2 mb-2'>
		<button type='button' class='btn btn-outline-Primary btn-md' data-bs-toggle="modal" data-bs-target="#addMaterial"><i class="fas fa-plus"></i> Add Material</button>
		<button type='button' class='btn btn-outline-Primary btn-md ms-1' data-bs-toggle="modal" data-bs-target="#showTypes"><i class="fas fa-clipboard-list"></i> Show types</button>
		<button type='button' class='btn btn-outline-Primary btn-md ms-1' data-bs-toggle="modal" data-bs-target="#showLevels"><i class="fas fa-user-graduate"></i> Show levels</button>
		<a class='btn btn-outline-Primary btn-md ms-1'><i class="fas fa-paper-plane"></i> Show requests</a>
</div>
<?php echo $__env->make('admin.materials.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.materials.types', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.materials.levels', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div id="materialsData"></div>

<!-- Fetch data from another page -->
<script>
	$(document).ready(function(){
		$('#keywords').tagsInput();
		$.ajax({
			url:"/Admin/Materials/FetchMaterials?MaterialsPage=1",
			success:function(data)
			{
				$('#materialsData').html(data);
			}
		})
		// Ajax for pages
		$(document).on('click', '.page-link', function(event){
			event.preventDefault();
			var page = $(this).attr('href').split('MaterialsPage=')[1];
			var url = "/Admin/Materials/FetchMaterials?MaterialsPage="+page
			if(isSearch){
				var subject = $('#subjectSearch').val();
				var type = $('#typeSearch').val();
				var level = $('#levelSearch').val();
				var keywords = $('#keywordsSearch').val();
				url = "/Admin/Materials/FilterMaterials?subject="+subject+'&type='+type+'&level='+level+'&keywords='+keywords+'&MaterialsPage='+page;
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
				url:"/Admin/Materials/FilterMaterials"+data,
				success:function(response)
				{
					$('#materialsData').html(response);
				}
			})
		}
	});
</script><?php /**PATH C:\3lmny\resources\views/admin/materials.blade.php ENDPATH**/ ?>