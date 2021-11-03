<!doctype html>
<?php echo $__env->make('templates.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="container">
		<?php echo $__env->yieldContent('content'); ?>
	</div>
<?php echo $__env->make('templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php /**PATH C:\cocolani\resources\views/templates/layout.blade.php ENDPATH**/ ?>