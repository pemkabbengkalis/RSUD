
<?php if(request()->is('/')): ?>
    
    <section id="hero-slider" class="hero-slider py-0 my-0">
  
            <div class="row">
              <div class="col-12">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
                    <?php $__currentLoopData = $post->index_by_group('banner','slider'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="carousel-item <?php if($loop->first): ?> active <?php endif; ?>">
                       <img src="<?php echo e(asset($row->post_thumbnail)); ?>" class="d-block w-100" alt="...">
                       <!-- <div class="carousel-caption d-none d-md-block">
                         <h5>Second slide label</h5>
                         <p>Some representative placeholder content for the second slide.</p>
                       </div> -->
                     </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
    </button>
    </div>
            </div>
          </div>
        </section>
        <?php endif; ?>
<div class="page-content">
        <!-- Slider -->
        <div class="section-full bg-light">
<div class="container pt-4 text-center ">
                        <div class="row justify-content-md-center">
                            <?php $__currentLoopData = getPost()->index('aplikasi'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-lg-2 col-4">
                                <a href="<?php echo e(url($row->post_url)); ?>" class="">
                                <div class="icon-bx-wraper center">
                                    <div class=" m-b20"> <img style="height:80px;border-radius:20px" data-original="<?php echo e(thumb($row->post_thumbnail)); ?>" alt=""></div>
                                    <div class="icon-content">
                                        <small class="dez-tilte text-uppercase"><?php echo e($row->post_title); ?></small>
                                        
                                    </div>
                                </div>
                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                        </div>
                    </div>
                    </div>
     
                
       
             
        <div class="content-area">
            <div class="container">
                <div class="row">
                    
                    <!-- Left part start -->
                    <div class="col-lg-9 col-md-8 col-sm-6">
   
               

                    <?php $__currentLoopData = $post->index_limit('sambutan',1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  
          <h3 class="text-uppercase">KATA SAMBUTAN Pimpinan</h3>
          <div class="dez-separator-outer ">
              <div class="dez-separator bg-secondry style-skew"></div>
          </div>
          <div class="clear"></div>
          <div style="padding:15px;border:4px dashed #ccc;border-radius:15px">
          <!-- <div class="pull-left">
          <img style="heigth:200px"  src="<?php echo e(thumb($row->post_thumbnail)); ?>" alt="">

<h5 class="dez-tilte text-uppercase"><?php echo e(_field($row,'nama_pemberi_sambutan')); ?></h5>
<p><?php echo e(_field($row,'jabatan')); ?></p>!-->
  <div class="row">
    
                    <div class="col-lg-4 text-center">
          <img class="rounded image-thumbnail"  src="<?php echo e(thumb($row->post_thumbnail)); ?>" alt="">
          <h5 class="dez-tilte text-uppercase m-0 mt-2"><?php echo e(_field($row,'nama_pemberi_sambutan')); ?></h5>
<p><?php echo e(_field($row,'jabatan')); ?></p>
          </div>
          <div class="col-lg-8">
       <?php echo $row->post_content; ?>

       </div>
       </div>

        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="row mt-4">
            <div class="col-lg-12">
            <div class="section-head text-center mt-4">
                        <h2 class="text-uppercase">Berita Terbaru</h2>
                        <div class="dez-separator-outer ">
                            <div class="dez-separator bg-primary style-skew"></div>
                        </div>
                 
                    </div>
            </div>
        </div>

                        <?php $__currentLoopData = $post->index_limit('berita',6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="blog-post blog-md clearfix date-style-2">
                            <div class="dez-post-media dez-img-effect zoom-slow"  style="background:none"> <a href="<?php echo e(url($row->post_url)); ?>"><img data-original="<?php echo e(thumb($row->post_thumbnail)); ?>" alt=""></a> </div>
                            <div class="dez-post-info">
                                <div class="dez-post-title ">
                                    <h3 class="post-title"><a href="<?php echo e(url($row->post_url)); ?>"><?php echo e($row->post_title); ?></a></h3>
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
                        <div class="pagination-bx clearfix m-b30 text-center">
                         <a href="<?php echo e(url('berita')); ?>" class="btn btn-primary btn-md"><i class="fa fa-newspaper" aria-hidden="true"></i> Semua Berita</a>
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

        <!-- About Company END -->
        <!-- Our Projects  -->
     <div class="container mb-4 pb-3">
     <center><a href="https://dinsos.bengkaliskab.go.id/tautan/sibos"><img class="w-50 rounded" src="https://sibos.bengkaliskab.go.id/assets/img/sibos.png" alt=""></a> <br><iframe style="width:100%;height:500px" src="https://www.youtube.com/embed/RQpYSkNXZVc" title="Company Profile SI BOS" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></center>
     </div>
     <div class="container">
     <div class="Section-full">
     <div class="section-head  text-center text-dark mb-2 mt-3">
                    <h2 class="text-uppercase"><i class="fa fa-camera" aria-hidden="true"></i> Gallery</h2>
                    <div class="dez-separator-outer ">
                        <div class="dez-separator bg-dark style-skew"></div>
                    </div>
             
                </div>
                    <div class="section-content text-center">
                        <div class="owl-carousel img-carousel-content lightgallery owl-btn-center-lr ">
                            <?php $__currentLoopData = getPost()->index_limit('foto',5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
								<div class="dez-box dez-gallery-box">
									<div class="dez-thum dez-img-overlay1 dez-img-effect zoom-slow"> <a href="javascript:void(0);"> 
										<img src="<?php echo e(thumb($row->post_thumbnail)); ?>"  alt="<?php echo e($row->post_title); ?>"> </a>
										<div class="overlay-bx">
											<div class="overlay-icon"> 
												<span data-exthumbimage="<?php echo e(thumb($row->post_thumbnail)); ?>" data-src="<?php echo e(thumb($row->post_thumbnail)); ?>" class="icon-bx-xs check-km lightimg" title="<?php echo e($row->post_title); ?>">		
													<i class="far fa-image"></i> 
												</span>
											</div>
										</div>
									</div>
								</div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     
                        </div>
                    </div>
                </div>
     </div>
            <div class="container">
                <div class="section-head  text-center text-dark mb-2">
                    <h2 class="text-uppercase">Unit Kerja</h2>
                    <div class="dez-separator-outer ">
                        <div class="dez-separator bg-dark style-skew"></div>
                    </div>
             
                </div>
                <div class="row">
                    <?php $no = 0;?>
                    <?php $__currentLoopData = getPost()->groups('unit-kerja'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $row->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="col-lg-4 col-md-4 col-sm-6 col-12 m-b30">
							<div class="box-number">
								<div class="number">
									<?php echo e($no+1); ?>

								</div>
                                <div class="icon-xl text-primary"> <a href="javascript:void(0);" class="icon-cell"><i class="flaticon-strategy"></i></a> </div>
								<h5><a href="<?php echo e(url($r->post_url)); ?>"><?php echo e($r->post_title); ?></a></h5>
								<p></p>
							</div>
						</div>
                    <?php $no++;?>
                        
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
					</div>
             
            </div>
            <!-- <div class="section-full text-white bg-img-fix content-inner overlay-black-dark" style="background-image:url(images/background/bg4.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6">
						<div class="counter-style-1 m-b30">
							<div class="icon-bx icon-md text-primary">
								<i class="flaticon-leader"></i>
							</div>
							<div class="counter-info">
								<div class="counter-num">
									<h2 class="counter text-white">1035</h2>
								</div>
								<h5 class="counter-text text-white">Active Experts</h5>
							</div>
						</div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
						<div class="counter-style-1 m-b30">
							<div class="icon-bx icon-md text-primary">
								<i class="flaticon-costumer"></i>
							</div>
							<div class="counter-info">
								<div class="counter-num">
									<h2 class="counter text-white">1226</h2>
								</div>
								<h5 class="counter-text text-white">Happy Client</h5>
							</div>
						</div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
						<div class="counter-style-1 m-b30">
							<div class="icon-bx icon-md text-primary">
								<i class="flaticon-development"></i>
							</div>
							<div class="counter-info">
								<div class="counter-num">
									<h2 class="counter text-white">1552</h2>
								</div>
								<h5 class="counter-text text-white">Developer Hand</h5>
							</div>
						</div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
						<div class="counter-style-1 m-b30">
							<div class="icon-bx icon-md text-primary">
								<i class="flaticon-finish-flag"></i>
							</div>
							<div class="counter-info">
								<div class="counter-num">
									<h2 class="counter text-white">1156</h2>
								</div>
								<h5 class="counter-text text-white">Completed Project</h5>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div> -->
 
        <div class="section-full  bg-white content-inner overlay-white-middle" style=" background-position:right center; background-repeat:no-repeat; background-size: auto 100%;">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="text-uppercase"> Kepegawaian</h2>
                    <div class="dez-separator-outer ">
                        <div class="dez-separator bg-secondry style-skew"></div>
                    </div>
          
                </div>
                   <?php echo $__env->make(blade_path('pegawai'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
        </div>
     
        <div class="section-full  bg-white content-inner overlay-white-middle" style="
        background-position:right center; background-repeat:no-repeat; background-size: auto 100%;">
        <div class="container">
                <div class="section-head text-center">
                    <h2 class="text-uppercase"> Media Sosial</h2>
                    <div class="dez-separator-outer ">
                        <div class="dez-separator bg-secondry style-skew"></div>
                    </div>
          
                </div>

                <div class="row justify-content-center">
          <div class="col-lg-6 text-center mb-4">
            <label for=""> <i class="fab fa-facebook" aria-hidden></i> Facebook</label>
            <div class="card" >
              <div class="card-body">

              <div id="fb-root" class="fb_reset" style="width:100%"></div>
              <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v14.0" nonce="CUe4ORWx"></script>
              <div class="fb-page" data-href="https://www.facebook.com/Dinsos.Bengkalis/" data-tabs="timeline" data-width="" data-height="100%" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Dinsos.Bengkalis/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Dinsos.Bengkalis/">Facebook</a></blockquote></div>
            </div>
          </div>

          </div>

          <div class="col-lg-6 text-center mb-4">
            <label for=""> <i class="fab fa-instagram" aria-hidden></i> Instagram</label>
            <div class="card">
              <div class="card-body" style="overflow:auto;height:530px">
                <div data-mc-src="5c81a9eb-5fde-4b16-9bb1-162241333282#instagram"></div>

      <script
        src="https://cdn2.woxo.tech/a.js#62cb59e219184b40af37cfe5"
        async data-usrc>
      </script>
            </div>
          </div>

          </div>

        </div>
      </div>
      </div>
        <div class="section-full dez-we-find bg-img-fix p-t50 p-b50 ">
            <div class="container">
                <div class="section-content">
                  <div class="row">
                    <div class="col-lg-8">
                    <div class="section-head text-center">
                    <h2 class="text-uppercase"> FAQ</h2>
                    <div class="dez-separator-outer ">
                        <div class="dez-separator bg-secondry style-skew"></div>
                    </div>
          
                </div>
                    <div class="dez-accordion rounded" id="accordion2">
                        <?php $no=0; ?>
                        <?php $__currentLoopData = getPost()->index('faq'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div class="panel">
										<div class="acod-head">
											<h5 class="acod-title"> <a data-bs-toggle="collapse" href="javascript:void(0);"  data-bs-target="#collapseOne<?php echo e($k); ?>" aria-expanded="true"><i class="fa fa-question" aria-hidden="true"></i> <?php echo e($row->post_title); ?></a> </h5>
										</div>
										<div id="collapseOne<?php echo e($k); ?>" class="acod-body collapse <?php if($no==0): ?> show <?php endif; ?> " data-bs-parent="#accordion2">
											<div class="acod-content"><?php echo $row->post_content; ?></div>
										</div>
									</div>
                                    <?php $no++; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
                    </div>
                    <div class="col-lg-4">
                    <div class="mb-3 text-center">
  <h3 class="text-muted">.::<b>Survei</b> Kepuasan::.</h3>
  Bagaimana Tingkat Kepuasan anda terhadap layanan kami ?
</div>

<div class="row justify-content-center">
  <?php echo e(emot_respon()); ?>

</div>
                    </div>
                  </div>
                </div>
            </div>
        </div> 
        <!-- Client logo END -->
    </div><?php /**PATH /home/kulipixe/cmsv2/templates/newzona/home.blade.php ENDPATH**/ ?>