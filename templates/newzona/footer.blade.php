<footer class="site-footer">
        <!-- newsletter part -->

        <!-- footer top part -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                        <div class="widget widget_about">
                            							<div class="logo-footer">
								<a href="index.html" class="logo-light"><img src="{{secure_asset(get_option('logo'))}}" alt=""></a>
							</div>				
                            <p>{{get_option('deskripsi_organisasi')}}</p>
                    
                        </div>
                    </div>
               
                    @foreach(collect(getMenu('header',true))->wherein('name',['Profil','Publikasi']) as $row)
                    <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                    <div class="widget widget_services">
                            <h4 class="m-b15 text-uppercase">{{$row->name}}</h4>
                            <div class="dez-separator-outer m-b10">
                                <div class="dez-separator bg-white style-skew"></div>
                            </div>
                            
                            <ul>
                            @foreach(getSub(getMenu('header'),$row->id) as $row2)

                                <li><a href="{{link_menu($row2->link)}}">{{$row2->name}}</a></li>
                                @endforeach
                            </ul>
         
                    </div>
                    </div>
                    @endforeach
          
                    <div class="col-lg-3 col-md-6 col-sm-6 footer-col-4">
                        <div class="widget widget_getintuch">
                            <h4 class="m-b15 text-uppercase">Info</h4>
                            <div class="dez-separator-outer m-b10">
                                <div class="dez-separator bg-white style-skew"></div>
                            </div>
                            <ul>
                                <li><i class="fas fa-map-marker-alt"></i><strong>Alamat</strong>{{get_option('alamat')}}</li>
                                <li><i class="fa fa-phone"></i><strong>Telp</strong> {{get_option('telp')}}</li>
                                <li><i class="fa fa-envelope"></i><strong>Email</strong>{{get_option('email')}}</li>
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
						<span>© {{date('Y')}} - {{get_option('nama_organisasi')}}</span> 
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
<script src="{{asset_path('js/jquery.min.js')}}"></script><!-- JQUERY.MIN JS -->
<script src="{{asset_path('plugins/bootstrap/js/popper.min.js')}}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{asset_path('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script><!-- BOOTSTRAP.MIN JS -->
<script src="{{asset_path('plugins/magnific-popup/magnific-popup.js')}}"></script><!-- MAGNIFIC POPUP JS -->
<script src="{{asset_path('plugins/perfect-scrollbar/js/perfect-scrollbar.min.js')}}"></script><!-- Perfect Scrollbar -->
<script src="{{asset_path('plugins/lightgallery/js/lightgallery-all.min.js')}}"></script>
<script src="{{asset_path('plugins/owl-carousel/owl.carousel.js')}}"></script><!-- OWL SLIDER -->
<script src="{{asset_path('js/custom.js')}}"></script><!-- CUSTOM FUCTIONS  -->
<script src="{{asset_path('js/dz.carousel.js')}}"></script><!-- SORTCODE FUCTIONS  -->
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
</html>