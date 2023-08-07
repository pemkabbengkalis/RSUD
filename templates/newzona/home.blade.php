
@if(request()->is('/'))
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($post->index_by_group('banner','slider') as $row)
      <div class="carousel-item {{$loop->first ? 'active' :''}}">
        <img src="{{thumb($row->post_thumbnail)}}" class="d-block w-100">
      </div>
      @endforeach

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
@endif

<div class="page-content">
        <!-- Slider -->
        <div class="content-area ">
            <div class="container">
                <div class="row">

        @foreach($post->index_limit('sambutan',1) as $row)

        <div class="section-head text-center">
            <h3 class="text-uppercase">SAMBUTAN PIMPINAN</h3>
            <div class="dez-separator-outer ">
                <div class="dez-separator bg-dark style-skew"></div>
            </div>

        </div>

        <div class="clear"></div>
        <div style="padding:15px;">
        <!-- <div class="pull-left">
        <img style="heigth:200px"  src="{{thumb($row->post_thumbnail)}}" alt="">

<h5 class="dez-tilte text-uppercase">{{_field($row,'nama_pemberi_sambutan')}}</h5>
<p>{{_field($row,'jabatan')}}</p>!-->
<div class="row">

                  <div class="col-lg-4 text-center">
        <img class="rounded image-thumbnail"  src="{{thumb($row->post_thumbnail)}}" alt="">
        <h5 class="dez-tilte text-uppercase m-0 mt-2">{{_field($row,'nama_pemberi_sambutan')}}</h5>
<p>{{_field($row,'jabatan')}}</p>
        </div>
        <div class="col-lg-8">
     {!!$row->post_content!!}
     </div>
     </div>

      </div>

      @endforeach
      </div>
      </div>
      </div>


        <div class="content-area">
            <div class="container">
                <div class="row">

                    <!-- Left part start -->
                    <div class="col-lg-9 col-md-8 col-sm-6">
        <div class="row">
            <div class="col-lg-12">
            <div class="section-head text-center">
                        <h2 class="text-uppercase">Berita Terbaru</h2>
                        <div class="dez-separator-outer ">
                            <div class="dez-separator bg-primary style-skew"></div>
                        </div>

                    </div>
            </div>
        </div>
        <div id="masonry" class="row dez-blog-grid-2">

                        @foreach($post->index_limit('berita',6) as $row)
                            <div class="post card-container col-lg-6 col-md-6 col-sm-12">
                                <div class="blog-post blog-grid date-style-2">
                                    <div class="dez-post-media dez-img-effect zoom-slow"> <a href="javascript:void(0);"><img src="{{thumb($row->post_thumbnail)}}" alt=""></a> </div>
                                    <div class="dez-post-info">
                                        <div class="dez-post-title ">
                                            <h3 class="post-title"><a href="{{url($row->post_url)}}">{{$row->post_title}}</a></h3>
                                        </div>
                                        <div class="dez-post-meta ">
                                            <ul>
                                                <li class="post-date"> <i class="fa fa-calendar"></i><strong>{{gettgl($row->created_at,'tglbulan')}}</strong> <span> {{gettgl($row->created_at,'tahun')}}</span> </li>
                                                <li class="post-author"><i class="fa fa-user"></i>By <a href="javascript:void(0);">{{$row->author->name}}</a> </li>

                                            </ul>
                                        </div>
                                        <div class="dez-post-text">
                                            <p>{{!empty($row->post_meta_description)  ? $row->post_meta_description : Str::limit(strip_tags($row->post_content),'150')}}</p>
                                        </div>
                                        <div class="dez-post-readmore"> <a href="{{url($row->post_url)}}" title="READ MORE" rel="bookmark" class="site-button-link">Selengkapnya<i class="fa fa-angle-double-right"></i></a> </div>

                                    </div>
                                </div>
                            </div>
                    @endforeach
                        <!-- Pagination start -->
                        <div class="pagination-bx clearfix m-b30 text-center">
                         <a href="{{url('berita')}}" class="btn btn-primary btn-md"><i class="fa fa-newspaper" aria-hidden="true"></i> Semua Berita</a>
                        </div>

                        <!-- Pagination END -->
                    </div>
                </div>
                    <!-- Left part END -->
                    <!-- Side bar start -->
                  @include(blade_path('sidebar'))
                    <!-- Side bar END -->
                </div>
            </div>
        </div>

        <!-- About Company END -->
        <!-- Our Projects  -->

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
                            @foreach(getPost()->index_limit('foto',5) as $row)
                            <div class="item">
								<div class="dez-box dez-gallery-box">
									<div class="dez-thum dez-img-overlay1 dez-img-effect zoom-slow"> <a href="javascript:void(0);">
										<img src="{{thumb($row->post_thumbnail)}}"  alt="{{$row->post_title}}"> </a>
										<div class="overlay-bx">
											<div class="overlay-icon">
												<span data-exthumbimage="{{thumb($row->post_thumbnail)}}" data-src="{{thumb($row->post_thumbnail)}}" class="icon-bx-xs check-km lightimg" title="{{$row->post_title}}">
													<i class="far fa-image"></i>
												</span>
											</div>
										</div>
									</div>
								</div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
     </div>



        <div class="section-full  bg-white content-inner overlay-white-middle" style=" background-position:right center; background-repeat:no-repeat; background-size: auto 100%;">
            <div class="container">
                <div class="section-head text-center">
                    <h2 class="text-uppercase"> Kepegawaian</h2>
                    <div class="dez-separator-outer ">
                        <div class="dez-separator bg-secondry style-skew"></div>
                    </div>

                </div>
                   @include(blade_path('pegawai'))
                </div>
        </div>

        <!-- Client logo END -->
    </div>
