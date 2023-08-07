<!DOCTYPE html>
<html lang="en">
<head>
<?php echo e(init_header()); ?>

	<link rel="stylesheet" type="text/css" href="<?php echo e(asset_path('css/plugins.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset_path('css/style.css')); ?>">
	<link class="skin" rel="stylesheet" type="text/css" href="<?php echo e(asset_path('css/skin/skin-4.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset_path('css/templete.css')); ?>">

	
	<!-- REVOLUTION SLIDER CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset_path('plugins/revolution/revolution/css/settings.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset_path('plugins/revolution/revolution/css/navigation.css')); ?>">
	<!-- REVOLUTION SLIDER CSS END -->
<style>
	  @media (max-width: 536px){
		.meet-ask-row {
  margin-top: 0;
}
}
</style>
</head>
<body id="bg"><div id="loading-area"></div>
<div class="page-wraper">
    <!-- header -->
	<header class="site-header header mo-left header-style-6 style-1">
		<!-- Contact Info -->
        <div class="bg-dark">
			<div class="container header-contant-block">
				<div class="row align-items-center">
					<div class="col-md-3">
						<a href="<?php echo e(url('/')); ?>" class="logo-dark">
							<img src="<?php echo e(secure_asset(get_option('logo'))); ?>" width="193" height="89" alt="">
						</a>
					</div>
					<div class="col-md-9">
						<ul class="contact-info clearfix">
							<li>
								<h6 class="text-primary"><i class="fa fa-phone text-primary"></i> Telp</h6>
								<span><?php echo e(get_option('telp')); ?></span> </li>
							<li>
								<h6 class="text-primary"><i class="far fa-envelope text-primary"></i> Email</h6>
								<span><?php echo e(get_option('email')); ?></span> </li>
							<li>
								<h6 class="text-primary"><i class="far fa-clock text-primary"></i> Jam kerja</h6>
								<span>Senin - Rabu: 08:00 - 16:00<br>Kamis - Jumat: 08:00 - 16:30</span></li>
							<li class="text-center"> 
							<img style="height:70px" src="https://bengkaliskab.go.id/bermasa-logo.png" alt="">
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- main header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="navigation-bar">
                    <div class="container clearfix">
                        <!-- website logo -->
                        <div class="logo-header mostion">
							<a href="index.html">
								<img src="<?php echo e(secure_asset(get_option('logo'))); ?>" width="193" height="89" alt="">
							</a>
						</div>
                        <!-- nav toggle button -->
						<button class="navbar-toggler collapsed navicon justify-content-end" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span></span>
							<span></span>
							<span></span>
						</button>
                        <!-- extra nav -->
                        <div class="extra-nav">
                            <div class="extra-cell">
                                <button id="quik-search-btn" type="button" class="site-button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                        <!-- Quik search -->
                        <div class="dez-quik-search bg-primary">
                            <form action="<?php echo e(url('search')); ?>" method="post">
                              <?php echo csrf_field(); ?>
                                <input name="querys"  type="text" class="form-control" placeholder="Type to search">
                                <span  id="quik-search-remove"><i class="fas fa-times"></i></span>
                            </form>
                        </div>
                        <!-- main nav -->
                        <div class="header-nav navbar-collapse collapse nav-dark justify-content-start" id="navbarNavDropdown">
                            <ul class="nav navbar-nav">
						
								<li>  <a href="<?php echo e(secure_url('/')); ?>"><i class="fa fa-home "></i> Beranda </a>
								
								</li>
								<?php $__currentLoopData = getMenu('header',true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if(empty(getSub(getMenu('header'),$row->id))): ?>

              <li><a href="<?php echo e(link_menu($row->link)); ?>"><?php echo e($row->name); ?></a></li>
                              
                              <?php else: ?>
                              <li ><a href='#'><?php echo e($row->name); ?> <i class="fa fa-angle-down"></i></a>
                                <ul class="sub-menu">
                                <?php $__currentLoopData = getSub(getMenu('header'),$row->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <?php if(!empty(getSub(getMenu('header'),$row2->id))): ?>

                                  <li ><a href="#"><?php echo e($row2->name); ?></a>
                <ul class="sub-menu">
                <?php $__currentLoopData = getSub(getMenu('header'),$row2->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(empty(getSub(getMenu('header'),$row3->id))): ?>

                  <li><a href="<?php echo e(link_menu($row3->link)); ?>"><?php echo e($row3->name); ?></a></li>
                <?php else: ?> 
                
                <li ><a href="#"><?php echo e($row3->name); ?> </a>
                <ul class="sub-menu">
                <?php $__currentLoopData = getSub(getMenu('header'),$row3->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row4): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  <li><a href="<?php echo e(link_menu($row4->link)); ?>"><?php echo e($row4->name); ?></a></li>
                
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
              </li>
                <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
              </li>
              <?php else: ?> 
              <li><a href="<?php echo e(link_menu($row2->link)); ?>"><?php echo e($row2->name); ?></a></li>

              <?php endif; ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                              </li>


          	<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
								
						
					
							</ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main header END -->
    </header>
<?php /**PATH /home/kulipixe/cmsv2/templates/newzona/header.blade.php ENDPATH**/ ?>