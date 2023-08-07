@extends('e-surat.layout',['title'=>'Ruang RT'])
@section('content')
<div class="row">
<div class="col-12">

<a href="{{url('/rt')}}" class="btn btn-danger btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Kembali</a><br><br>
</div>
    <div class="col-md-12 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Detail Permohonan</span>
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
            <li class="list-group-item">
             @php 
             $kolom = collect(get_module())->where('name','permohonan')->first()['custom_field'];
             $cek = App\Models\Posts::wherePostId($p->post_parent)->wherePostType('layanan')->first();
             @endphp
             <label class="text-muted m-0">Jenis Permohonan</label>
                    <h5 class="m-0 mb-2 text-primary" style="right:0">{{_field($p,'jenis_pelayanan')}}</h5>
                    <span class="text-muted m-0 pull-left">Kode REG</span>
                    <h6 class="m-0 pull-right"><b>{{$p->post_title}}</b></h6><br>
                    <hr>
             @foreach(collect($kolom)->where([1],'!=','array')->where([1],'!=','break') as $r)
          @php $field = underscore($r[0]); @endphp
                    <span class="text-muted m-0 pull-left">{{$r[0]}}</span>
                    <h6 class="m-0 pull-right">{{_field($p,$field)}}</h6><br>
                    <hr>
        @endforeach
               
        @foreach(collect(_loop($cek))->where('jenis','!=','Array')->where('status','Aktif')->sortBy('sort') as $r)
          @php $k = underscore($r->kolom); 
          $f = $r->jenis!='Break' ? json_decode($p->data_field,true)['data'][$k]:'';
          @endphp
          @if($r->jenis=='File')
          <span class="text-muted pull-left">{{$r->kolom}}</span>
        <a href="{{asset($f)}}" class="btn btn-info btn-sm pull-right">Lihat</a><br>
        <hr>

          @elseif($r->jenis=='Break')
          @if($r->kolom) <h5>{{$r->kolom}}</h5>@endif
          @else
          <span class="text-muted m-0 pull-left">{{$r->kolom}}</span>
                    <h6 class="m-0 pull-right" style="right:0">{{$f ?? '__'}}</h6><br>
          <hr>

          @endif
        @endforeach

        @php 
$fc = collect(_loop(\App\Models\Posts::wherePostId($p->post_parent)->select('data_loop')->first()))->where('jenis','Array')->first();
$fi = json_decode($p->data_field,true);
@endphp
@if($fc)
<div class="table-responsive">
              <table class="table table-bordered" style="font-size:small;background:#fff">
                <thead>
                  <tr>
            <th>#</th>
            @foreach(json_decode($fc->deskripsi) as $ar)
            <th>{{Str::remove($fc->kolom,Str::headline($ar->field))}}</th>
            @endforeach
            </tr>
            </thead>
            <tbody class="coldata">
                @foreach($fi['data'][Str::lower($fc->kolom)] as $no=>$b)
                <tr>
                <td>{{$no+1}}</td>

              @foreach(json_decode($fc->deskripsi) as $ar)
              @php $fl = $ar->field; @endphp
              <td>
                {{$b[$fl]}}
           </td>
            @endforeach
              </tr>
              @endforeach
            </tbody>
</table>
</div>
@endif
@if(is_null($p->post_pin))
              <br>
              <br>
        <div class="alert alert-warning">
                <label for="">Setelah melihat data permohonan ini saya menyatakan data ini adalah </label><br>
                <form action="{{URL::full()}}" method="post">
                    @csrf
                
                <input required type="radio"  name="status" {{$p->post_pin == 1 ? 'checked':''}} value="1"> <b>Valid</b> <br>
                <input required type="radio" name="status" value="0" {{!is_null($p->post_pin) &&  $p->post_pin == 0 ? 'checked':''}}> <b>Tidak Valid </b><br>
                Dengan Catatan : 
                <textarea placeholder="Tulis Catatan" type="text" class="form-control form-control-sm" name="post_content">{{$p->post_content ?? ''}}</textarea>
                <br>
                <button class="btn btn-md btn-danger text-right" type="submit" name="validasi" value="true" onclick="return confirm('Validasi hanya bisa dilakukan sekali, Apakah anda yakin untuk melanjutkan ?')">Submit</button>
                <br>
                </form>
                </div>
         @else 
        <div class="alert alert-warning">
          <b>Catatan :</b><br>{{$p->post_content ?? '-'}}
</div>
         @endif 

            </li> 
          </ul>

        </div>

       

</div>
@endsection