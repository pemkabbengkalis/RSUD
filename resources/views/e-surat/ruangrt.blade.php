@extends('e-surat.layout',['title'=>'Ruang RT'])
@section('content')
<div class="row">
    <div class="col-md-12 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Daftar Permohonan ke RT {{session('rtname')}} / RW {{session('rwname')}}</span>
            <span class="badge badge-secondary badge-pill">{{count($data)}}</span>
          </h4>
          <ul class="list-group mb-3">
            @forelse($data as $r)
            <li style="cursor:pointer" onclick="location.href='{{url('rt/'.$r->post_id)}}'" class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">{{_field($r,'jenis_pelayanan')}}</h6>
                <small class="text-muted">Kode REG : <b>{{$r->post_title}}</b><br>Pemohon : {{_field($r,'nama_pemohon')}} <br>NIK : {{_field($r,'nik_pemohon')}}<br>Alamat : {{_field($r,'alamat_pemohon')}}</small><br>
                @if($r->post_status=='publish')
                <span class="badge badge-primary mt-2">Selesai <i class="fa fa-check" aria-hidden="true"></i></span>
                @else
                @if(!is_null($r->post_pin))
               
                @if($r->post_pin == 1)
                <span class="badge badge-success mt-2">Valid</span>
                @else
                <span class="badge badge-danger mt-2">Tidak Valid</span>
                @endif
                @else
                <span class="badge badge-warning mt-2">Belum Divalidasi</span>
                @endif
                @endif
              </div>
              

              <span class="text-primary">{{time_ago($r->created_at)}}
              
            </span>
            </li> 
            @empty
            <li class=" list-group-item d-flex justify-content-between lh-condensed">
              <center class="text-danger">Belum ada permohonan</center>
            </li>
            @endforelse        
          </ul>

        </div>

       

</div>
@endsection