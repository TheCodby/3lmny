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
								<input type="text" class="form-control">
							</div>
							<div class="col-4">
								<label for="basic-url" class="form-label">Type</label>
								<select class="form-select" aria-label="All">
								  <option selected>Choose type</option>
								  <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<div class='form-group row'>
							<div class="col-6">
								<label for="basic-url" class="form-label">Level</label>
								<select class="form-select" aria-label="All">
								  	<option selected>All</option>
									<?php $__currentLoopData = $levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($level->id); ?>"><?php echo e($level->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php echo $__env->make('admin.materials.add', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.materials.types', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('admin.materials.levels', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
			<?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<th scope="row"><?php echo e($material->id); ?></th>
					<td><?php echo e($material->subject); ?></td>
					<?php
						@$keywords = explode(",", $material->keywords)
					?>
					<td>
					<?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<span class="badge rounded-pill bg-primary"><?php echo e($keyword); ?></span>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
					<td><?php echo e($material->created_at); ?></td>
					<td><?php echo e($material->updated_at); ?></td>
					<td><a href='<?php echo e(route("admin.materials.edit", $material->id)); ?>' class='btn btn-outline-success'>Edit</a></td>
					<td><a href='<?php echo e(route("admin.materials.delete", $material->id)); ?>' class='btn btn-outline-danger'>Delete</a></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<?php echo e($materials->links()); ?>

</div><?php /**PATH C:\3lmny\resources\views/admin/materials.blade.php ENDPATH**/ ?>