@extends('e-surat.layout',['title'=>'Selamat datang Di Sistem Pelayanan Kelurahan Kota Kec. Bengkalis Kab. Bengkalis'])
@section('content')
<div class="row">
  @if(session()->has('success'))
  <div class="col-lg-12">
  <div class="jumbotron bg-white">
  <h1 class="display-4"><b>{{session('success') ?? null}}</b></h1>
  <p class="lead"></p>
  <hr class="my-4">
  <p class="alert alert-success" style="font-size:20px">Permohonan berhasil dibuat, silahkan catat kode registrasi diatas untuk kebutuhan melihat status permohonan dan pengambilan berkas pada kantor lurah. Terima kasih</p>
</div>
  </div>
  @endif

  @if(session()->has('danger'))
  <div class="col-lg-12">
<div class="alert alert-danger">{!!session('danger')!!}</div>
  </div>
  @endif
         <div class="col-md-12 order-md-1 mb-4">
     
          @if($p)

<a href="{{url('/')}}" class="btn btn-danger btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Kembali</a><br><br>
       @include('e-surat.det')
          @else
          <form class="card p-2" action="{{URL::full()}}" method="post">
          @csrf
            <div class="input-group">
              <input type="text" class="form-control" name="kode" placeholder="Masukkan Kode Registrasi Permohonan" required>
              <div class="input-group-append">
                <button type="submit" class="btn btn-primary" name="lacak" value="true"><i class="fa fa-search" aria-hidden="true"></i> Periksa </button>
              </div>
            </div>
          </form>
          <br>
          <h6 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted"><i class="fa fa-check    "></i> Pilih pelayanan yang diinginkan</span> <span  class="float-end text-muted"><i class="fa fa-bar-chart" aria-hidden="true"></i> Pemohon</span>
          </h6>
          
          <div id="accordion">
            @foreach($post->group('layanan') as $k=>$r)
  <div class="card">
    <div class="card-header" id="headingOne{{$k}}"  data-toggle="collapse" data-target="#collapseOne{{$k}}" aria-expanded="true" aria-controls="collapseOne{{$k}}">
      <h6 class="mb-0 text-dark">
        {{$r->group_name}} <i class="fa fa-angle-down float-right text-muted" aria-hidden="true"></i>
      </h6>
    </div>

    <div id="collapseOne{{$k}}" class="collapse " aria-labelledby="headingOne{{$k}}" data-parent="#accordion">
      <div class="card-body p-0">
      <ul class="list-group">

       @foreach($post->index_by_group('layanan',$r->group_id) as $l)
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">{!!_field($l,'status_layanan')=='Aktif' ? '<span class="text-success">&bullet;</span>':'<span class="text-danger">&bullet;</span>'!!}  <a href="{{url('buat/'.$l->post_name)}}">{{$l->post_title}}</a> </h6>
               
              </div>
              <span class="text-muted"><span class="badge badge-info">{{count($post->index_child('permohonan',$l->post_id))}}</span></span>
            </li>
       @endforeach
          </ul>
      </div>
    </div>
  </div>

@endforeach
</div>
        @endif
         
        </div> 
  
     
      </div>
      @endsection