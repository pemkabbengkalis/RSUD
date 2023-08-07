<div class="col-lg-3 col-md-4 col-sm-6">
                        <aside class="side-bar">
                        <div class="widget ">
                            {!!get_banner('<div class="mb-3">','</div>','banner-samping')!!}
                        </div>
                            <div class="widget recent-posts-entry">
                                <h4 class="widget-title"> <i class="fa fa-rss" aria-hidden="true"></i> Berita Popular</h4>
                                <div class="widget-post-bx">
                                    @foreach(getPost()->index_popular('berita') as $row)
                                    <div class="widget-post clearfix">
                                        <div class="dez-post-media" style="background:none"> <img src="{{thumb($row->post_thumbnail)}}" alt="" width="200" > </div>
                                        <div class="dez-post-info">
                                            <div class="dez-post-header">
                                                <h6 class="post-title"><a href="{{url($row->post_url)}}">{{$row->post_title}}</a></h6>
                                            </div>
                                            <div class="dez-post-meta">
                                                <ul>
                                                    <li class="post-author">By <a href="{{url($row->post_url)}}">{{$row->author->name}}</a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                            @if(get_module_info('group') || request()->is('/'))
                            <div class="widget widget_categories">
                                <h4 class="widget-title"><i class="fa fa-tags" aria-hidden="true"></i> Kategori {{$title ?? 'Berita'}}</h4>
                                <ul>
                                    @foreach(request()->is('/') ? getPost()->groups('berita') : getPost()->groups($post_type) as $row)
                                    <li><a href="{{url($row->url)}}">{{$row->name}}</a> ({{$row->total_posts}})</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif


                            <div class="widget   widget_services">
                                <h5 class="widget-title"> <i class="fa fa-warning" aria-hidden="true"></i> Pengumuman</h5>
                                <ul class="pt-0">
                                    @foreach(getPost()->index('pengumuman') as $row)
                                    <li><a href="{{url($row->post_url)}}">{{Str::headline($row->post_title)}}</a></li>
                                    @endforeach
                                </ul>
                        </div>
                        </aside>
                    </div>
