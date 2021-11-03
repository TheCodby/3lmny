

<?php $__env->startSection('title', __('titles.admin')); ?>

<?php $__env->startSection('content'); ?>
	<div class='container'>
		<div class='row'>
			<?php if(session()->has('message')): ?>
			<div class="alert alert-success d-flex align-items-center mb-3" role="alert">
			  <div>
				<?php echo e(session()->get('message')); ?>

			  </div>
			</div>
			<?php endif; ?>
			<?php if(!$errors->isEmpty()): ?>
			<div class="alert alert-danger d-flex align-items-center mb-3" role="alert">
			  <div>
				<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div><?php echo e($error); ?></div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			  </div>
			</div>
			<?php endif; ?>
			<div class='card p-2 mb-5'>
				<ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
				  <li class="nav-item" role="presentation">
					<button class="nav-link active" id="analysis-tab" data-bs-toggle="tab" data-bs-target="#analysis" type="button" role="tab" aria-controls="analysis" aria-selected="true"><i class="fas fa-chart-line"></i> Analysis</button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link" id="materials-tab" data-bs-toggle="tab" data-bs-target="#materials" type="button" role="tab" aria-controls="materials" aria-selected="true"><i class="fas fa-book"></i> Materials <span class="badge bg-primary rounded-pill">1</span></button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true"><i class="fas fa-users"></i> Users <span class="badge bg-primary rounded-pill">1</span></button>
				  </li>
				  <li class="nav-item" role="presentation">
					<button class="nav-link" id="suggestions-tab" data-bs-toggle="tab" data-bs-target="#suggestions" type="button" role="tab" aria-controls="suggestions" aria-selected="true"><i class="fas fa-brain"></i> Suggestions <span class="badge bg-primary rounded-pill">1</span></button>
				  </li>
				</ul>
				<div class='card-body'>
					<div class="tab-content" id="tabContent">
						<div class="tab-pane fade show active" id="analysis" role="tabpanel" aria-labelledby="analysis-tab">
							
						</div>
						<div class="tab-pane fade" id="materials" role="tabpanel" aria-labelledby="materials-tab">
							<?php echo $__env->make('admin.materials', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('templates.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\3lmny\resources\views/admin/home.blade.php ENDPATH**/ ?>