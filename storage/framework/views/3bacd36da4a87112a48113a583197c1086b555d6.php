

<?php $__env->startSection('title', __('titles.materials')); ?>

<?php $__env->startSection('content'); ?>
	<div class='container position:relative;'>
		<div class="row">
			<div class='col-sm-4'>
				<div class="card shadow mb-3 sticky-top">
					<div class='card-header'><h3 class="card-title"><i class="fas fa-search"></i> Search</h3></div>
					<div class="card-body ">
					<form method='POST' action="<?php echo e(route('materials')); ?>" >
						<div class='form-group row'>
							<div class="col-sm-8">
								<label for="basic-url" class="form-label">Subject</label>
								<input type="text" class="form-control">
							</div>
							<div class="col-sm-4">
								<label for="basic-url" class="form-label">Type</label>
								<select class="form-select" aria-label="All">
									<option selected>All</option>
									<?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
							</div>
						</div>
						<div class='form-group row'>
							<div class="col-sm-6">
								<label for="basic-url" class="form-label">Level</label>
								<select class="form-select" aria-label="All">
									<option selected>All</option>
									<option value="1">Primary education</option>
									<option value="2">Middle education</option>
									<option value="3">High school</option>
									<option value="4">College education</option>
								</select>
							</div>
							<div class="col-sm-6">
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
				<?php $__currentLoopData = $materials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="row mb-3">
						<div class="col-sm-12 mx-auto">
								<div class="card rounded shadow card-hover custom-card">
								<div class="row g-0">
									<div class="col-md-4">
										<img src="<?php echo e(asset('images/materials/1.jpeg')); ?>" class="img-fluid h-100">
									</div>
									<div class="col-md-8">
									<div class="card-body">
										<h5 class="card-title"><?php echo e($material->subject); ?></h5>
										<?php
											@$keywords = json_decode($material->keywords)
										?>
										<?php $__currentLoopData = $keywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $keyword): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<p class="badge rounded-pill bg-primary"><?php echo e($keyword); ?></p>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<p>Type: <?php echo e($material->materialTypes->name); ?></p>
										<p class="card-text"><?php echo e($material->description); ?></p>
										<p class="card-text"><small class="text-muted">Last Updated <?php echo e($material->updated); ?></small></p>
										<a href="#" class="stretched-link float-end"></a>
									</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\3lmny\resources\views/browse/home.blade.php ENDPATH**/ ?>