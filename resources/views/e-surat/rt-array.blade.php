<table class="bg-white mt-4 table table-bordered">
@foreach(collect(_loop(\App\Models\Posts::wherePostId($p->post_parent)->select('data_loop')->first()))->where('jenis','!=','Break')->where('jenis','!=','Array') as $r)
    <tr>
        <td>{{$r->kolom}}</td>
        <td>@if($r->jenis=='File') <a class="w-100 btn btn-sm btn-info" target="_blank" href="{{asset($field['data'][underscore($r->kolom)])}}"> <i class="fa fa-eye"></i> Lihat</a> @else {{$field['data'][underscore($r->kolom)]}} @endif</td>
    </tr>
@endforeach
</table>
@php 
$fc = collect(_loop(\App\Models\Posts::wherePostId($p->post_parent)->select('data_loop')->first()))->where('jenis','Array')->first();
@endphp
@if($fc)
<h6>{{$fc->kolom}}</h6>
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
                @foreach($field['data'][Str::lower($fc->kolom)] as $no=>$b)
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