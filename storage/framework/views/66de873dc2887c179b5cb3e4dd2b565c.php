         
                    <div class="section-content">
                        <div class="img-carousel-content owl-carousel owl-btn-center-lr">
                        <?php $__currentLoopData = getPost()->groups('kepegawaian'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $r->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      
                            <div class="item">
                                <div class="ow-carousel-entry">
                                    <div class="ow-entry-media dez-img-effect zoom-slow"> <a href="javascript:void(0);"><img src="<?php echo e(thumb($row->post_thumbnail)); ?>" alt=""></a> </div>
                                 
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div><?php /**PATH C:\laragon\www\cmsv2\templates/newzona/pegawai.blade.php ENDPATH**/ ?>