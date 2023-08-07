         
                    <div class="section-content">
                        <div class="img-carousel-content owl-carousel owl-btn-center-lr">
                        @foreach(getPost()->groups('kepegawaian') as $r)
                        @foreach($r->posts as $row)
                      
                            <div class="item">
                                <div class="ow-carousel-entry">
                                    <div class="ow-entry-media dez-img-effect zoom-slow"> <a href="javascript:void(0);"><img src="{{thumb($row->post_thumbnail)}}" alt=""></a> </div>
                                 
                                </div>
                            </div>
                            @endforeach
                        @endforeach
                        </div>
                    </div>