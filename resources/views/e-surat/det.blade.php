<h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">{{$p->post_title}}</span>
            @if($p->post_status=='publish')
            <span class="badge badge-primary mt-2">Selesai <i class="fa fa-check" aria-hidden="true"></i></span>
            @else
            @if(!is_null($p->post_pin))
                @if($p->post_pin == 1)
                <span class="badge badge-success">Valid</span>
                @else
                <span class="badge badge-danger">Tidak Valid</span>
                @endif

                @else
                <span class="badge badge-warning ">Belum Divalidasi</span>
                @endif
                @endif
          </h4>
          
          <ul class="list-group mb-3">
        
            <li class="list-group-item ">
    
             @php 
             $kolom = collect(get_module())->where('name','permohonan')->first()['custom_field'];
             $cek = App\Models\Posts::wherePostId($p->post_parent)->wherePostType('layanan')->first();
             @endphp
             <label class="text-muted m-0">Jenis Permohonan</label>
                    <h5 class="m-0 mb-2 text-primary" style="right:0">{{_field($p,'jenis_pelayanan')}}</h5>
             @foreach(collect($kolom)->where([1],'!=','array')->where([1],'!=','break') as $r)
          @php $field = underscore($r[0]); @endphp
                    <label class="text-muted m-0">{{$r[0]}}</label>
                    <h5 class="m-0 mb-2 " style="right:0">
                    @if(in_array(_us($r[0]),['nik_pemohon','nomor_telp_atau_wa_pemohon']))
                    {{Str::mask(_field($p,$field), '*', -4)}}
                    @else
                    {{_field($p,$field)}}
                    @endif
                  </h5>
        @endforeach
<!--                
        @foreach(collect(_loop($cek))->where('jenis','!=','Break')->where('jenis','!=','Array')->where('status','Aktif')->sortBy('sort') as $r)
          @php $k = underscore($r->kolom); 
          $f = json_decode($p->data_field,true)['data'][$k];
          @endphp
          @if($r->jenis=='File')
       
          @else
          <label class="text-muted m-0">{{$r->kolom}}</label>
                    <h5 class="m-0 mb-2 " style="right:0">{{$f}}</h5>
          @endif
        @endforeach -->
             
  
              
            </li> 
          </ul>