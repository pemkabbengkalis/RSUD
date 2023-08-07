<footer class="site-footer">
        <!-- newsletter part -->

        <!-- footer top part -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                        <div class="widget widget_about">
                            							<div class="logo-footer">
								<a href="index.html" class="logo-light"><img src="<?php echo e(secure_asset(get_option('logo'))); ?>" alt=""></a>
							</div>				
                            <p><?php echo e(get_option('deskripsi_organisasi')); ?></p>
                    
                        </div>
                    </div>
               
                    <?php $__currentLoopData = collect(getMenu('header',true))->wherein('name',['Profil','Publikasi']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_services">
                            <h4 class="m-b15 text-uppercase"><?php echo e($row->name); ?></h4>
                            <div class="dez-separator-outer m-b10">
                                <div class="dez-separator bg-white style-skew"></div>
                            </div>
                            
                            <ul>
                            <?php $__currentLoopData = getSub(getMenu('header'),$row->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <li><a href="<?php echo e(link_menu($row2->link)); ?>"><?php echo e($row2->name); ?></a></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
         
                    </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
                    <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                        <div class="widget widget_getintuch">
                            <h4 class="m-b15 text-uppercase">Info</h4>
                            <div class="dez-separator-outer m-b10">
                                <div class="dez-separator bg-white style-skew"></div>
                            </div>
                            <ul>
                                <li><i class="fas fa-map-marker-alt"></i><strong>Alamat</strong><?php echo e(get_option('alamat')); ?></li>
                                <li><i class="fa fa-phone"></i><strong>Telp</strong> <?php echo e(get_option('telp')); ?></li>
                                <li><i class="fa fa-envelope"></i><strong>Email</strong><?php echo e(get_option('email')); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer bottom part -->
        <div class="footer-bottom footer-line">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
						<span>© <?php echo e(date('Y')); ?> - <?php echo e(get_option('nama_organisasi')); ?></span> 
					</div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer END-->
    <!-- scroll top button -->
    <button class="scroltop fa fa-arrow-up" ></button>
</div>
<!-- JavaScript  files ========================================= -->
<script src="<?php echo e(asset_path('js/jquery.min.js')); ?>"></script><!-- JQUERY.MIN JS -->
<script src="<?php echo e(asset_path('plugins/bootstrap/js/popper.min.js')); ?>"></script><!-- BOOTSTRAP.MIN JS -->
<script src="<?php echo e(asset_path('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script><!-- BOOTSTRAP.MIN JS -->
<script src="<?php echo e(asset_path('plugins/magnific-popup/magnific-popup.js')); ?>"></script><!-- MAGNIFIC POPUP JS -->
<script src="<?php echo e(asset_path('plugins/perfect-scrollbar/js/perfect-scrollbar.min.js')); ?>"></script><!-- Perfect Scrollbar -->
<script src="<?php echo e(asset_path('plugins/lightgallery/js/lightgallery-all.min.js')); ?>"></script>
<script src="<?php echo e(asset_path('plugins/owl-carousel/owl.carousel.js')); ?>"></script><!-- OWL SLIDER -->
<script src="<?php echo e(asset_path('js/custom.js')); ?>"></script><!-- CUSTOM FUCTIONS  -->
<script src="<?php echo e(asset_path('js/dz.carousel.js')); ?>"></script><!-- SORTCODE FUCTIONS  -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>
  <script type="text/javascript">
	$("img").lazyload({
	    effect : "fadeIn"
	});
</script>
<script>

    $('#myTable').DataTable();
</script>
</body>
</html><?php /**PATH C:\laragon\www\cmsv2\templates/newzona/footer.blade.php ENDPATH**/ ?>