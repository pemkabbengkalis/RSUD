<div class="page-content">
        <!-- inner page banner -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="javascript:void(0);">Beranda</a></li>
                    <li><?php echo e(get_post_type($post_type)); ?></li>
                    <li><?php echo e($title); ?></li>
                </ul>
            </div>
        </div>
 
        <!-- Breadcrumb row END -->
        <div class="content-area">
            <div class="container">
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-lg-9 col-md-8 col-sm-6">
                    <div class="section-head text-center">
                        <h2 class="text-uppercase">Berita</h2>
                        <div class="dez-separator-outer ">
                            <div class="dez-separator bg-primary style-skew"></div>
                        </div>
                    </div>
                        <?php $__currentLoopData = $index; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="blog-post blog-md clearfix date-style-2">
                            <div class="dez-post-media dez-img-effect zoom-slow"  style="background:none"> <a href="<?php echo e(secure_url($row->post_url)); ?>"><img data-original="<?php echo e(thumb($row->post_thumbnail)); ?>" alt=""></a> </div>
                            <div class="dez-post-info">
                                <div class="dez-post-title ">
                                    <h3 class="post-title"><a href="<?php echo e(secure_url($row->post_url)); ?>"><?php echo e($row->post_title); ?></a></h3>
                                </div>
                                <div class="dez-post-meta ">
                                    <ul>
                                        <li class="post-date"> <i class="fa fa-calendar"></i><strong><?php echo e(gettgl($row->created_at,'tglbulan')); ?></strong> <span> <?php echo e(gettgl($row->created_at,'tahun')); ?></span> </li>
                                        <li class="post-author"><i class="fa fa-user"></i>By <a href="javascript:void(0);"><?php echo e($row->author->name); ?></a> </li>
                                        <?php if($row->allow_comment==1): ?>
                                                    <li class="post-comment"><i class="fa fa-comments"></i> <?php echo e($row->comments->count()); ?></li>
                                                    <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="dez-post-text">
                                    <p><?php echo Str::limit(strip_tags($row->post_content),250); ?></p>
                                </div>
                               
                              
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <!-- Pagination start -->
                        <div class="pagination-bx clearfix m-b30">
                        <?php echo e($index->links('vendor.pagination.bootstrap-5')); ?>

                        </div>
                        <!-- Pagination END -->
                    </div>
                    <!-- Left part END -->
                    <!-- Side bar start -->
                  <?php echo $__env->make(blade_path('sidebar'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!-- Side bar END -->
                </div>
            </div>
        </div>
    </div><?php /**PATH /home/kulipixe/cmsv2/templates/newzona/berita/group.blade.php ENDPATH**/ ?>