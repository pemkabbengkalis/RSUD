<div class="col-lg-3 col-md-4 col-sm-6">
                        <aside class="side-bar">
                        <div class="widget ">
                            <?php echo get_banner('<div class="mb-3">','</div>','banner-samping'); ?>

                        </div>
                            <div class="widget recent-posts-entry">
                                <h4 class="widget-title"> <i class="fa fa-rss" aria-hidden="true"></i> Berita Popular</h4>
                                <div class="widget-post-bx">
                                    <?php $__currentLoopData = getPost()->index_popular('berita'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="widget-post clearfix">
                                        <div class="dez-post-media" style="background:none"> <img src="<?php echo e(thumb($row->post_thumbnail)); ?>" alt="" width="200" > </div>
                                        <div class="dez-post-info">
                                            <div class="dez-post-header">
                                                <h6 class="post-title"><a href="<?php echo e(url($row->post_url)); ?>"><?php echo e($row->post_title); ?></a></h6>
                                            </div>
                                            <div class="dez-post-meta">
                                                <ul>
                                                    <li class="post-author">By <a href="<?php echo e(url($row->post_url)); ?>"><?php echo e($row->author->name); ?></a></li>
                                                  
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                  
                                </div>
                            </div>
                            <?php if(get_module_info('group') || request()->is('/')): ?>
                            <div class="widget widget_categories">
                                <h4 class="widget-title"><i class="fa fa-tags" aria-hidden="true"></i> Kategori <?php echo e($title ?? 'Berita'); ?></h4>
                                <ul>
                                    <?php $__currentLoopData = request()->is('/') ? getPost()->groups('berita') : getPost()->groups($post_type); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="javascript:void(0);"><?php echo e($row->name); ?></a> (<?php echo e($row->total_posts); ?>)</li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                    
                          
                            <div class="widget   widget_services">
                                <h5 class="widget-title"> <i class="fa fa-warning" aria-hidden="true"></i> Pengumuman</h5>
                                <ul class="pt-0">
                                    <?php $__currentLoopData = getPost()->index('pengumuman'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><a href="<?php echo e(url($row->post_url)); ?>"><?php echo e(Str::headline($row->post_title)); ?></a></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                        </div>
                        </aside>
                    </div><?php /**PATH /home/kulipixe/cmsv2/templates/newzona/sidebar.blade.php ENDPATH**/ ?>