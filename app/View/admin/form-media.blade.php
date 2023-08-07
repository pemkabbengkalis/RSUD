@extends('admin.layout.app',['title'=>'Lihat Media'])
@section('content')

   <div class="row">
      <div class="col-lg-12">
         <h3 style="font-weight:normal"><i class="fa {{get_module_info('icon')}}" aria-hidden="true"></i> Lihat Media<a href="{{admin_url(get_post_type())}}" class="btn btn-outline-danger btn-sm pull-right"> <i class="fa fa-undo" aria-hidden></i> Kembali</a></h3>
         <br>
      </div>
      <div class="col-lg-7">
   @if(allowed_ext(_field($edit,'extension'))=='image')
            <img class="img-thumbnail w-100" src="{{thumb($edit->post_url)}}" alt="">
   @elseif(_field($edit,'extension')=='pdf')
   <iframe style="width:100%;height:80vh;border:0;" src="{{secure_asset($edit->post_url)}}" frameborder="0"></iframe>
   @elseif(_field($edit,'extension')=='docx' || _field($edit,'extension')=='doc')
   <iframe style="width:100%;height:80vh;border:0;"  src="https://docs.google.com/gview?url={{secure_asset($edit->post_url)}}&embedded=true"></iframe>

   @else
   <center><img class="img-rounded" height="150" src="{{img_ext(_field($edit,'extension'))}}" alt=""></center>
   @endif
         
         </div>
         <div class="col-lg-5" >

         @foreach(get_module_info('custom_field') as $r)
         <small for="">{{$r[0]}} :</small><br>
         <label>{{$field[underscore($r[0])] ?? '-'}}</label><br>
         @endforeach
         
         <small for="">Waktu Upload :</small><br>
         <label>{{$edit->created_at}}</label><br>
         <small for="">Diupload dari :</small><br>
         @php 
         $src = src_post($edit->post_parent);
         @endphp
         <label><a href="{{$src}}" style="word-break: break-all;">{{$src}}</a> </label>
   <br><small>Link Media : </small><br>
   <label> <a href="{{url($edit->post_url)}}" style="word-break: break-all;">{{url($edit->post_url)}}</a></label>
   <small for="">Oleh :</small><br>
         <label>{{$edit->author->name}}</label><br>
      </div>
      
   </div>

@endsection
