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
			<script src="https://kit.fontawesome.com/ba6d6c4c2b.js" crossorigin="anonymous"></script>
			<link rel="stylesheet" href="css/jquery_tagsinput.css">
			<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
		</head>
	<body>
	<script type="text/javascript" src="<?php echo e(asset('js/app.js')); ?>"></script>
	<script src="js/jquery_tagsinput.js"></script>
	<nav class="navbar navbar-custom navbar-light navbar-expand-lg shadow-sm p-3 mb-5" id='navbar'>
		<div class="container-fluid">
			<ul class='nav navbar-nav' style="display:inline-block;">
				<li class="nav-item"><a class="navbar-brand" href="<?php echo e(route('index')); ?>">
					<!-- <img src="https://seeklogo.com/images/L/logo-com-hr-logo-5636A4D2D5-seeklogo.com.png" alt="" width="50" height="50" class="d-inline-block align-text-top" /> -->
					<?php echo e(__('titles.3lmny')); ?>

				</a></li>
				<li class="nav-item"><ul class="navbar-nav">
					<li class="nav-item dropdown">
					  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						<span class="flag-icon flag-icon-<?php echo e($available_locales[Config::get('app.locale')][1]); ?>"></span>
					  </a>
					  <ul class="dropdown-menu" style="min-width:inherit;position:absolute;" aria-labelledby="navbarDropdown">
						<?php $__currentLoopData = $available_locales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locales): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php if(Config::get('app.locale') != $locales[0]): ?>
								<li><a class="dropdown-item" href="<?php echo e(route('lang', $locales[0])); ?>"> <?php echo e($locales[2]); ?> <span class="flag-icon flag-icon-<?php echo e($locales[1]); ?>"></span></a></li>
							<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					  </ul>
					</li>
				</ul></li>
			</ul>
			<ul class='nav navbar-nav d-flex flex-row-reverse' style="display:inline-block;">
				<?php if(auth()->guard()->check()): ?>
					<li class='nav-item'><div class="dropdown">
					  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
						<i class="fas fa-user-circle"></i> <?php echo e(Auth::user()->username); ?>

					  </a>
					<?php if(app()->getLocale() == 'ar'): ?>
						<ul class="dropdown-menu" style="position:absolute;" aria-labelledby="dropdownMenuLink">
					<?php else: ?>
						<ul class="dropdown-menu dropdown-menu-end" style="position:absolute;" aria-labelledby="dropdownMenuLink">
					<?php endif; ?>
						<li><a class="dropdown-item" href="#">Account</a></li>
						<li><a class="dropdown-item" href="#">Settings</a></li>
						<li><a class="dropdown-item" href="#">Bookmarks</a></li>
						<?php if(Auth::user()->user_type == '2'): ?>
						<li><a class="dropdown-item" href="<?php echo e(route('admin')); ?>">Admin Panel</a></li>
						<?php endif; ?>
						<li><hr class="dropdown-divider"></li>
						<li><a class="dropdown-item" href="<?php echo e(route('logout')); ?>"><?php echo e(ucfirst(__('buttons.logout'))); ?></a></li>
						
					  </ul>
					</div></li>
				<?php endif; ?>
				<?php if(auth()->guard()->guest()): ?>
					<li class="nav-item"><a type="button" class="btn btn-primary navbar-btn menu-item" href="<?php echo e(route('login')); ?>"><i class="fas fa-user"></i> <?php echo e(ucfirst(__('buttons.login'))); ?></a></li>
				<?php endif; ?>
				<li class="nav-item"><a type="button" href="<?php echo e(route('materials')); ?>" class="btn btn-outline-primary navbar-btn menu-item d-none d-sm-block"><i class="fas fa-book"></i> <?php echo e(ucfirst(__('buttons.materials'))); ?></a></li>
				<li class="nav-item"><a type="button" class="btn btn-gold navbar-btn menu-item d-none d-sm-block"><i class="fas fa-hand-holding-usd"></i> <?php echo e(ucfirst(__('buttons.donate'))); ?></a></li>
			</ul>
		</div>
	</nav>
<?php echo $__env->yieldSection(); ?><?php /**PATH C:\3lmny\resources\views/templates/header.blade.php ENDPATH**/ ?>