<div class="page-content">
<div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="javascript:void(0);">Beranda</a></li>
                    <li><?php echo e(get_post_type($post_type)); ?></li>
                </ul>
            </div>
        </div>
        <div class="content-area">
            
            <div class="container">
                <div class="row">
                    <!-- Left part start -->
                    <div class="col-lg-9 col-md-8 col-sm-6">
                  
                    <div class="blog-post blog-single">
                            <div class="dez-post-title p-0">
                            <div class="section-head text-left mb-0">
                        <h2  style="line-height:normal"><?php echo e($detail->post_title); ?></h2>
                        <div class="dez-separator-outer ">
                            <div class="dez-separator bg-primary style-skew"></div>
                        </div>
                    </div>
                            </div>
                            <div class="dez-post-meta m-b20">
                                <ul>
                                    <li class="post-date"> <i class="fa fa-calendar"></i> <?php echo e(tglindo($detail->created_at)); ?> </li>
                                    <li class="post-author"><i class="fa fa-user"></i><a href="javascript:void(0);"><?php echo e($detail->author->name); ?></a> </li>
                                    <?php if(get_module_info('group') && $detail->group->count()>0): ?>
                                    <li class="post-tags"><i class="fa fa-tags"></i>
                                    <?php echo get_group($detail->group); ?>

                                </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                     
                         
                            <div class="dez-post-text">
                                <?php echo $detail->post_content; ?>

                            </div>
                            <div class="dez-post-tags clear">
                                <div class="post-tags"> 
                                <?php echo keyword_search($detail->post_meta_keyword); ?>

                                    
                            </div>
                            </div>
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
    </div><?php /**PATH /home/kulipixe/cmsv2/templates/newzona/halaman/detail.blade.php ENDPATH**/ ?>