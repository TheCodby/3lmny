<?php $__env->startSection('header'); ?>
	<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
		<head>
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
			<title>Cocolani - <?php echo $__env->yieldContent('title'); ?></title>
			<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
		</head>
	<body>
	<nav class="navbar navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">
				<img src="https://www.cocolani.net/images/logo.png" alt="" width="74.6" height="51.3" class="d-inline-block align-text-top" />
			</a>
			<button type="button" class="btn btn-primary d-flex">Play</button>
		</div>
	</nav>
<?php echo $__env->yieldSection(); ?><?php /**PATH C:\cocolani\resources\views/templates/header.blade.php ENDPATH**/ ?>