<?php $__env->startSection('header'); ?>
<?php
	@$available_locales  = Config::get('app.locales');
?>
	<?php if(app()->getLocale() == 'ar'): ?>
		<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="rtl">
	<?php else: ?>
		<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<?php endif; ?>
		<head>
			<title><?php echo e(__('titles.3lmny')); ?> - <?php echo $__env->yieldContent('title'); ?></title>
			<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet" type="text/css" >
			<script src="https://unpkg.com/feather-icons"></script>
			<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
			<link href="<?php echo e(asset('css/jquery_tagsinput.css')); ?>" rel="stylesheet" type="text/css" >
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
			<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		</head>
	<body>
	<script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
	<script src="<?php echo e(asset('js/jquery_tagsinput.js')); ?>"></script>
<?php echo $__env->yieldSection(); ?><?php /**PATH C:\3lmny\resources\views/templates/header.blade.php ENDPATH**/ ?>