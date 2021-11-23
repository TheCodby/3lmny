<?php $__env->startSection('title', __('titles.main')); ?>

<?php echo $__env->make('templates.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php
	@$available_locales  = Config::get('app.locales');
?>
	<script src="https://cdn.jsdelivr.net/npm/typed.js@latest/lib/typed.min.js"></script>
	<div style='width: 100%;overflow: hidden;position:relative'>
		<div class="h-100" style='background-color:#3b3bad;'>
			<nav class="navbar navbar-expand-md" id='navbar' style='direction: ltr;'>
				<div class="container-fluid">
					<a class="navbar-brand fs-4 text-light" href="<?php echo e(route('index')); ?>"><?php echo e(__('titles.3lmny')); ?></a>
					<ul class="navbar-nav me-auto">
							<li class="nav-item">
								<ul class="navbar-nav">
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
								</ul>
							</li>
						</ul>
						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
							<span class="fas fa-bars" style='color:#fff'></span>
						</button>
					<div class="collapse navbar-collapse" id="navbarContent">
						<ul class="navbar-nav index ms-auto">
								<li class="nav-item ms-2 mt-2 mt-md-0 fs-6"><a type="button" href="<?php echo e(route('materials')); ?>" class="navbar-btn menu-item button3 btn btn-link text-capitalize"><i data-feather="book-open" stroke-width='2' width='22px' height='22px'></i> <?php echo e(__('buttons.materials')); ?></a></li>
								<?php if(auth()->guard()->guest()): ?>
									<li class="nav-item ms-2 mt-2 mt-md-0 fs-6"><a type="button" class="menu-item button3 btn btn-link text-capitalize" href="<?php echo e(route('login')); ?>"><i data-feather="log-in" stroke-width='2' width='22px' height='22px'></i> <?php echo e(__('buttons.login')); ?></a></li>
									<li class="nav-item ms-2 mt-2 mt-md-0 fs-6"><a type="button" class="btn btn-primary fw-bold" href="<?php echo e(route('register')); ?>"><i data-feather="user-plus" stroke-width='2' width='22px' height='22px'></i> <?php echo e(__('buttons.joinnow')); ?></a></li>
								<?php endif; ?>
							<?php if(auth()->guard()->check()): ?>
								<li class="nav-item ms-2 mt-2 mt-md-0 fs-6"><a type="button" href="<?php echo e(route('donation')); ?>" class="navbar-btn menu-item button3 btn btn-link text-capitalize"> <?php echo e(__('buttons.donate')); ?></a></li>
								<li class='nav-item ms-2 mt-2 mt-md-0 fs-6'><div class="dropdown">
								<a class="button3 btn btn-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
									<i data-feather="user"></i> <?php echo e(Auth::user()->username); ?>

								</a>
								<ul class="dropdown-menu dropdown-menu-end" style="position:absolute;" aria-labelledby="dropdownMenuLink">
									<li><a class="dropdown-item" href="<?php echo e(route('myprofile')); ?>">Profile</a></li>
									<li><a class="dropdown-item disabled" href="#">Settings <p class="badge rounded-pill bg-danger mb-0">Soon!</p></a></li>
									<li><a class="dropdown-item" href="<?php echo e(route('materials.bookmarks')); ?>">Bookmarks</a></li>
									<?php if(Auth::user()->user_type == '2'): ?>
									<li><a class="dropdown-item" href="<?php echo e(route('admin')); ?>">Admin Panel</a></li>
									<?php endif; ?>
									<li><hr class="dropdown-divider"></li>
									<li><a class="dropdown-item text-capitalize" href="<?php echo e(route('logout')); ?>"><i data-feather="log-out" stroke-width='2' width='22px' height='22px'></i> <?php echo e(__('buttons.logout')); ?></a></li>
									
								</ul>
								</div>
							</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</nav>
			<div class="caption row justify-content-around">
				<div class='col-md-6'>
					<h2 id='typing' class='text-light text-center'></h2>
					<h5 id='typing2' style='opacity:0;padding: 10px' class='text-light text-center'><?php echo e(__('messages.indextext')); ?></h5>
				</div>
				<div class='col-md-3 d-flex justify-content-center'>
					<img id='books' src="<?php echo e(asset('images/css/png/books.png')); ?>" width="256" height="256"> </object>
				</div>
			</div>
		</div>
		<div class="wave">
			<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
				<path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
				<path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
				<path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
			</svg>
		</div>
	</div>
	<div style='width: 100%;overflow: hidden;position:relative;background-color:#2F334C;' >
		<div class="row justify-content-center" style='margin-bottom: 100px'>
			<div class="col-md-4">
				<div class="card text-white text-center p-2 border-dark mb-3 mt-5 border-0" style='background-color:#2F334C'>
					<i class='align-self-center' data-feather="book-open" stroke-width='2' width='72px' height='72px'></i>
					<div class="card-body">
						<h5 class="card-title"><?php echo e($MaterialsCount); ?> Materials</h5>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card text-white text-center p-2 border-dark mb-3 mt-5 border-0" style='background-color:#2F334C'>
					<i class='align-self-center' data-feather="users" stroke-width='2' width='72px' height='72px'></i>
					<div class="card-body">
						<h5 class="card-title"><?php echo e($UsersCount); ?> Users</h5>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card text-white text-center p-2 border-dark mb-3 mt-5 border-0" style='background-color:#2F334C'>
				<i class='align-self-center' data-feather="eye" stroke-width='2' width='72px' height='72px'></i>
					<div class="card-body">
						<h5 class="card-title"><?php echo e($VisitorsCount); ?> Visitors</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="wave">
			<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
				<path d="M1200 120L0 16.48 0 0 1200 0 1200 120z" style='fill:#3b3bad' class="shape-fill"></path>
			</svg>
		</div>
	</div>
	<div style='width: 100%;overflow: hidden;position:relative;background-color:#1f2233;'>
		<div style='margin-bottom: 100px'>
			<div class="row justify-content-center mt-5 p-4">
				<h3 class='text-light text-center'>Contact Us</h3>
				<div class='col-md-6 d-flex justify-content-center'>
					<img id='books' src="<?php echo e(asset('images/css/png/contactus.png')); ?>" style='max-width:100vw;'> </object>
				</div>
				<div class='col-md-4' id='contactinputs'>
					<div class="form-floating mb-3 text-light">
						<input type="text" name='name' id='name' style='background-color:#151722;' class="form-control custominput text-light" id="floatingInput">
						<label for="floatingInput">Your Name</label>
					</div>
					<div class="form-floating mb-3 text-light">
						<input type="email" name='email' id='email' style='background-color:#151722;' class="form-control custominput text-light" id="floatingInput">
						<label for="floatingInput">Email</label>
					</div>
					<div class="form-floating mb-3 text-light">
						<input type="text" name='subject' id='subject' style='background-color:#151722;' class="form-control custominput text-light" id="floatingInput">
						<label for="floatingInput">Subject</label>
					</div>
					<div class="form-floating text-light">
						<textarea style='background-color:#151722;' id='message' name='message' class="form-control custominput text-light h-50" id="floatingTextarea2" style="height: 100px"></textarea>
						<label for="floatingTextarea2">Message</label>
					</div>
					<div class="d-flex justify-content-center">
						<button type="button" id='sendMessage' class="btn btn-success mt-2 align-self-center">Submit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function () {
			$( "#navbar" ).removeClass( "mb-5" );
			//
			var txt = "<?php echo e(__('messages.greeting')); ?>";
			var i = 0;
			var speed = 100;
			
			function typingEffect(eleID, txt)
			{
				if (i < txt.length)
				{
					document.getElementById(eleID).innerHTML += txt.charAt(i);
					i++;
					setTimeout(typingEffect, speed, eleID, txt)
				}else{
					$( "#typing2" ).animate({
						opacity: 1,
						padding: 0,
					}, 2000, function() {
						// Animation complete.
					});
				}
			}
			typingEffect('typing', txt)
			// Contact us code
			$(document).on('click', '#sendMessage', function(event){
				event.preventDefault();
				var name = $('#name').val();
				var email = $('#email').val();
				var subject = $('#subject').val();
				var message = $('#message').val();
				$(this).html(`
					<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  					<span class="visually-hidden">Loading...</span>
				`);
				$(this).prop('disabled', true);
				$.ajax({
					type : 'POST',
					url : "<?php echo e(route('contact.send')); ?>",
					data : {'name': name, 'email': email, 'subject': subject, 'message': message},
					success:function(response)
					{
						$( "#contactinputs" ).animate({
						opacity: 0,
						padding: 1,
						}, 2000, function() {
							$('#contactinputs').html(`
								<h3 class='text-center'><i class="fas fa-check-circle" style='font-size: 144px;color:#008000;'></i></h3></br>
								<h3 class='card-title text-center text-light'>${response.message}</h3>
							`);
							$( "#contactinputs" ).animate({
							opacity: 1,
							padding: 0,
							}, 2000, function() {
								// Animation complete.
							});
						});
					},
					error: function(error)
					{
						$(this).prop('disabled', false);
					}
				})
			});
		});
	</script>
<?php echo $__env->make('templates.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\3lmny\resources\views/index.blade.php ENDPATH**/ ?>