<div class="page-content">
        <!-- inner page banner -->

        <!-- inner page banner END -->
        <!-- Breadcrumb row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="javascript:void(0);">Home</a></li>
                    <li>Kepegawaian</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb row END -->
        <div class="content-area">
            <!-- Left & right section start -->
            <div class="container">
                <!-- Gallery -->
                <div class="section-head text-center">
                        <h2 class="text-uppercase"><?php echo e(get_post_type($post_type)); ?></h2>
                        <div class="dez-separator-outer ">
                            <div class="dez-separator bg-primary style-skew"></div>
                        </div>
                    </div>
                    <div class="section-content">
                            <ul id="masonry" class="row dez-gallery-listing gallery-grid-4 m-lr0 lightgallery">

                        <?php $__currentLoopData = getPost()->groups('kepegawaian'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $r->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      
                        <li class="home card-container col-md-4 col-sm-6 mb-1">

								<div class="dez-box dez-gallery-box">
									<div class="dez-thum dez-img-overlay1 dez-img-effect zoom-slow"> <a href="javascript:void(0);"> 
										<img src="<?php echo e(thumb($row->post_thumbnail)); ?>"  alt=""> </a>
										<div class="overlay-bx">
											<div class="overlay-icon"> 
												<span data-exthumbimage="<?php echo e(thumb($row->post_thumbnail)); ?>" data-src="<?php echo e(thumb($row->post_thumbnail)); ?>" class="icon-bx-xs check-km lightimg"  title="<?php echo e($row->post_title); ?>">		
													<i class="far fa-image"></i> 
												</span>
											</div>
										</div>
									</div>
								</div>
							</li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
                 
                    </ul>
                    </div>
                <!-- Gallery END -->
                <!-- Pagination start -->
            
                <!-- Pagination END -->
            </div>
            <!-- Left & right section  END -->
        </div>
    </div><?php /**PATH /home/kulipixe/cmsv2/templates/newzona/kepegawaian/index.blade.php ENDPATH**/ ?>