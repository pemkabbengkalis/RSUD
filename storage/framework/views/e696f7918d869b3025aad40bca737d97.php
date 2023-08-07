<!DOCTYPE html>
<html lang="en">
<head>
<?php echo e(init_header()); ?>

	<link rel="stylesheet" type="text/css" href="<?php echo e(asset_path('css/plugins.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset_path('css/style.css')); ?>">
	<link class="skin" rel="stylesheet" type="text/css" href="<?php echo e(asset_path('css/skin/skin-3.css')); ?>">
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
.main-bar,.is-fixed .main-bar{
    background: rgb(92,212,131);
background: linear-gradient(270deg, rgba(92,212,131,1) 0%, rgba(0,176,239,1) 100%);
}
ul.nav.navbar-nav li a {
  color:#fff
}
ul.nav.navbar-nav li a:hover {
  color:#dbe938
}
.header-curve .logo-header::before, .header-curve .logo-header::after {
  background-color: #ffffff;
  content: "";
  position: absolute;
  bottom: 0;
  height: 120%;
  z-index: -1;
}
</style>
</head>
<body id="bg"><div id="loading-area"></div>
  <div class="page-wraper">
      <!-- header -->
      <header class="site-header header mo-left header-style-1 " >
          <!-- top bar -->
          <div class="top-bar no-skew">
              <div class="container">
          <div class=" d-flex bar align-items-center justify-content-between">
            <div class="dez-topbar-left">

            </div>
            <div class="dez-topbar-right">
              <ul class="social-bx list-inline pull-right">
                <li><a target="_blank" href="<?php echo e(get_option('facebook')); ?>"><i class="fab fa-facebook-f"></i></a></li>
                <li><a target="_blank" href="<?php echo e(get_option('instagram')); ?>"><i class="fab fa-instagram"></i></a></li>
                <li><a target="_blank" href="<?php echo e(get_option('youtube')); ?>"><i class="fab fa-youtube"></i></a></li>
              </ul>
            </div>
          </div>
              </div>
          </div>
          <!-- top bar END-->
          <!-- main header -->
          <div class="sticky-header  header-curve main-bar-wraper navbar-expand-lg">
              <div class="main-bar bg-primary clearfix ">
                  <div class="container clearfix">
                      <!-- website logo -->
                      <div class="logo-header mostion bg-light ">
              <a href="<?php echo e(secure_url('/')); ?>">
                <img src="<?php echo e(asset(get_option('logo'))); ?>" width="193" height="89" alt="">
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
                          <form action="#">
                              <input name="search" value="" type="text" class="form-control" placeholder="Type to search">
                              <span  id="quik-search-remove"><i class="fas fa-times"></i></span>
                          </form>
                      </div>
                      <!-- main nav -->
                       <div class="header-nav navbar-collapse collapse justify-content-end" id="navbarNavDropdown">
              <!-- Website Logo -->
              <div class="logo-header mostion">
                <a href="index.html" class="logo-dark"><img src="<?php echo e(asset(get_option('logo'))); ?>" width="193" height="89" alt=""></a>
              </div>
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
          <!-- main header END -->
      </header>
<?php /**PATH C:\laragon\www\cmsv2\templates/newzona/header.blade.php ENDPATH**/ ?>