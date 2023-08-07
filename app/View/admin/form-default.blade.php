@extends('admin.layout.app',['title'=>get_module_info('title_crud')])
@section('content')
<form class="editor-form" action="{{URL::full()}}" method="post" enctype="multipart/form-data">
   @csrf
   <div class="row">
      <div class="col-lg-12">
         <h3 style="font-weight:normal"> <i class="fa {{get_module_info('icon')}}" aria-hidden="true"></i> {{get_module_info('title_crud')}} <a href="{{admin_url(get_post_type())}}" class="btn btn-outline-danger btn-sm pull-right" data-toggle="tooltip" title="Kembali Ke Index Data"> <i class="fa fa-undo" aria-hidden></i> Kembali</a></h3>
         <br>
         @if(!empty($edit && get_module_info('detail') && $edit->post_title))
         <div style="border-left:3px solid green" class="alert alert-success"><b>URL : </b><a title="Kunjungi URL" data-toggle="tooltip" href="{{url($edit->post_url)}}" target="_blank"><i><u>{{url($edit->post_url)}}</u></i></a> <span title="Klik Untuk Menyalin alamat URL {{get_module_info('title')}}" data-toggle="tooltip" class="pointer copy pull-right badge badge-primary" data-copy="{{url($edit->post_url)}}"><i class="fa fa-copy" aria-hidden></i> <b>Salin</b></span></div>
         @endif
      </div>
      <div class="col-lg-9">
         <div class="form-group">
            <input data-toggle="tooltip" title="Masukkan {{get_module_info('data_title')}}"  required name="post_title"  type="text" value="{{$edit->post_title ?? ''}}" placeholder="Masukkan {{get_module_info('data_title')}}" class="form-control form-control-lg">
          
         </div>
         
         @if(get_module_info('editor'))
         <div class="form-group">
           @if($edit->mime_type=='html')
           <textarea style="height:70vh" class="form-control text-white bg-dark" name="post_content" placeholder="Masukkan Script HTML">{{get_custom_view($edit->post_id)}}</textarea>
          @else
            <textarea name="post_content" placeholder="Keterangan..." id="editor">{{$edit->post_content ?? ''}}</textarea>
            @endif
         </div>
         @endif
         @if(get_module_info('post_parent'))
         <?php 
         if(isset(get_module_info('post_parent')[1])){
            if(isset(get_module_info('post_parent')[2]) && get_module_info('post_parent')[2]!='all'){
                  // echo "<script>alert('oi');</script>";
                  $par =  App\Models\Post::withwherehas('group.group',function($q){
                     $q->where('slug',get_module_info('post_parent')[2]);
                  })->wherePostType(get_module_info('post_parent')[1])->wherePostStatus('publish')->select('post_id','post_title')->get(); 
                  
               }
               else{
                  $par =  App\Models\Post::wherePostType(get_module_info('post_parent')[1])->wherePostStatus('publish')->select('post_id','post_title')->get(); 
   
            }
            }
         ?>
         <h6>{{get_module_info('post_parent')[0]}}</h6>
         <select @if(isset(get_module_info('post_parent')[3]) && get_module_info('post_parent')[3]=='required') required @endif class="form-control form-control-sm" name="post_parent">
            <option value="">--pilih--</option>
         
            @foreach($par as $row)
            <option @if($edit && $edit->post_parent == $row->post_id) selected @endif value="{{$row->post_id}}">{{$row->post_title}}</option>
            @endforeach

         </select>
        
         @endif

         @if(get_module_info('custom_field'))
         @foreach(get_module_info('custom_field') as $r)
         @if(is_array($r[1]))
         <small>{{$r[0]}}</small> 
         <select class="form-control form-control-sm" name="{{underscore($r[0])}}">
            <option value="">--pilih--</option>
            @foreach($r[1] as $i)
            <option {{(!empty($field) && isset($field[underscore($r[0])]) && $field[underscore($r[0])]==$i)? 'selected':'' }} value="{{$i}}">{{$i}}</option>
            @endforeach
         </select>
         @elseif($r[1]=='file')
         <small for="">{{$r[0]}}</small>
         <input  @if(isset($r[2]) && $r[2] =='required') required @endif @if($field && isset($field[underscore($r[0])]) && $field[underscore($r[0])] && file_exists(public_path($field[underscore($r[0])]))) disabled   title="Hapus dokumen terlebih dahulu sebelum mengganti"  @else  data-toggle="tooltip"  title="Pilih dokumen baru"  @endif onchange="readFile(this);" @if(!empty($field[underscore($r[0])]))  @endif value="{{$field[underscore($r[0])] ?? ''}}" class="form-control-file form-control form-control-sm" name="{{underscore($r[0])}}" type="file" placeholder="Masukkan {{$r[0]}}">

         <input value="{{$field && isset($field[underscore($r[0])]) && file_exists(public_path($field[underscore($r[0])])) ? $field[underscore($r[0])] : null }}" name="old_{{underscore($r[0])}}" type="hidden">
         @if($field && isset($field[underscore($r[0])]) && $field[underscore($r[0])] && file_exists(public_path($field[underscore($r[0])])))<small> <a data-toggle="tooltip"  title="Lihat Dokumen" class="badge badge-primary" href="{{asset($field[underscore($r[0])])}}" ><i class="fa fa-eye" aria-hidden="true"></i> </a> <i style="cursor:pointer" onclick="if(confirm('Hapus dokumen ?')){exeurl('{{$field[underscore($r[0])]}}')}" data-toggle="tooltip"  title="Hapus dokumen" class="fa fa-trash text-danger"></i></small> <br> @endif
         @elseif($r[1]=='break')
         <br>
         <h6 for="" style="border-bottom:1px dashed #000">{{$r[0]}}</h6>
         @elseif($r[1]=='array')
        
         @elseif(underscore($r[0])=='tanggal_entry')
        
         <small for="">{{$r[0]}}</small>
         <input @if(isset($r[2]) && $r[2] =='required') required @endif type="datetime-local" value="{{$field[underscore($r[0])] ?? ''}}" class="form-control form-control-sm" name="{{underscore($r[0])}}" placeholder="Entri {{$r[0]}}">

         @else
         <small for="">{{$r[0]}}</small>
         <input @if(isset($r[2]) && $r[2] =='required') required @endif @if($r[1]=='number') oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" @endif value="{{$field[underscore($r[0])] ?? ''}}" class="form-control form-control-sm" name="{{underscore($r[0])}}" type="{{$r[1]=='number'?'text':$r[1]}}" placeholder="Entri {{$r[0]}}">
         @endif
         @endforeach
         @endif



      @if((get_module_info('looping') && get_post_type() !='halaman') || (get_post_type() =='halaman' && $edit->mime_type=='html'))
         <br>
         <h6 style="border-bottom:1px dashed #000;font-weight:normal"><b>{{get_module_info('looping')}}</b> <span class="text-muted pull-right">{{get_module_info('looping_for')}}</span> </h6>

         @if(get_module_info('post_type') != 'menu')
            @if(get_module_info('post_type') == 'lasyanan')
               @include('admin.hasil-skm')
            @else
               @include('admin.looping-data')
            @endif
         @else
            @include('admin.list-menu')
         @endif

      @endif
      </div>
      <div class="col-lg-3">
         @if(get_module_info('thumbnail'))
         <div class="card">
            <p class="card-header"> <i class="fa fa-image" aria-hidden></i> Gambar</p>
            <!-- <img style="height: 200px; width: 100%; display: block;" src="https://user-media-prod-cdn.itsre-sumo.mozilla.net/uploads/products/2020-04-14-08-36-13-8dda6f.png"> -->
            <img class="img-responsive" style="border:none" id="thumb" src="{{thumb($edit->post_thumbnail)}}" />
            <input onchange="readURL(this);" type="file" class="form-control-file form-control-sm" name="post_thumbnail" value="">
            @if(get_module_info('index') && get_module_info('detail'))
            <span style="padding:10px">
            <textarea placeholder="Keterangan Gambar" type="text" class="form-control form-control-sm" name="post_thumbnail_description">{{$edit->post_thumbnail_description ?? ''}}</textarea>
            </span>
            @endif
         </div>
         <script>
            function readURL(input) {
              const allow = ['gif','png','jpeg','jpg','GIF','PNG','JPEG','JPG'];
              var ext = input.value.replace(/^.*\./, '');
              if(!allow.includes(ext)){
                alert('Pilih hanya gambar');
                input.value='';
              }else {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#thumb')
                            .attr('src', e.target.result)
                            .width('100%')
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            }

         </script>
         @endif
         @if(get_module_info('post_type')=='halaman')
         <small>Tampilan Halaman</small>
         <select class="form-control form-control-sm" name="mime_type">
           <option value="">Bawaan Template</option>
            <option value="html" {{$edit && $edit->mime_type=='html'?'selected':''}}>Kustom HTML</option>
         </select>
         <!-- <small>Nama Domain {!!help("Opsi Jika Ingin mengakses halaman ini sebagai domain khusus")!!} </small>
         <input type="text" class="form-control form-control-sm" name="domain_custom" placeholder="namadomain.com" value="{{$edit->domain_custom ?? ''}}"> -->
         @endif
         @if(get_module_info('detail'))
         <small>Pengalihan URL {!!help("Opsi Jika Ingin Mengalihkan Konten Ini ke suatu halaman web atau url")!!} </small>
         <input type="text" class="form-control form-control-sm" name="redirect_to" placeholder="URL dimulai https:// atau http://" value="{{$edit->redirect_to ?? ''}}">
         <small for="">Deskripsi {!!help("Opsi deskripsi singkat tentang konten yang dapat ditelusuri oleh mesin pencarian")!!} </small>
         <textarea placeholder="Tulis Deskripsi" type="text" class="form-control form-control-sm" name="post_meta_description">{{$edit->post_meta_description ?? ''}}</textarea>
         <small for="">Kata Kunci  {!!help("Kata kunci tentang konten yang dapat ditelusuri oleh mesin pencarian")!!}</small>
         <input placeholder="Keyword1,Keyword2,Keyword3" type="text" class="form-control form-control-sm" name="post_meta_keyword" value="{{$edit->post_meta_keyword ?? ''}}">
         @endif
         @if(get_module_info('group'))
         <small for="">Kategori  {!!help("Pengelompokan kategori konten")!!}</small><br>
         <select  class="form-control form-control-sm" id="demoSelect" multiple="" name="post_group[]">
            <optgroup label="Pilih">
               @foreach(App\Models\Group::where('status',1)->where('type',get_post_type())->orderBy('sort','asc')->get() as $row)
               <option value="{{$row->id}}" {{($edit && in_array($row->id,json_decode($edit->group->pluck('group_id'),true)) ? 'selected=selected' : '')}}>{{$row->name}}</option>
               @endforeach
            </optgroup>
         </select>
         <div class="text-right"><small class="text-primary"><a href="{{admin_url(get_post_type().'/group')}}"> <i class="fa fa-plus" aria-hidden></i> Tambah Baru</a></small></div>
         @else
         
         @endif

         @if(get_module_info('detail'))
         
         <div @if(!get_module_info('group')) style="margin-top:10px" @endif  class="animated-checkbox">
            <label>
            <input type="checkbox" {{($edit && $edit->allow_comment == 1)? 'checked=checked':''}} name="allow_comment" value="1"><span class="label-text"><small>Izinkan Komentar  {!!help("Jika dicentang, maka pengunjung bisa mengirim komentar pada postingan ini")!!}</small></span>
            </label>
         </div>
         @endif
         @if(get_module_info('thumbnail'))
         <div class="animated-checkbox">
            <label>
            <input {{($edit && $edit->post_pin == 1)? 'checked=checked':''}} type="checkbox" name="post_pin" value="1"><span class="label-text"><small>Sematkan  {!!help("Jika dicentang, maka postingan ini akan menjadi prioritas dihalaman jika dikondisikan pada template ")!!}</small></span>
            </label>
         </div>
         @endif
         <div class="form-group form-inline">
            <div class="animated-radio-button">
               <label>
               <input {{($edit && $edit->post_status == 'publish')? 'checked=checked':''}} required type="radio" name="post_status" value="publish"><small class="label-text">Publikasikan</small>
               </label>
            </div>
            &nbsp;&nbsp;&nbsp;
            <div class="animated-radio-button">
               <label>
               <input {{($edit && $edit->post_status == 'draft')? 'checked=checked':''}} required type="radio" name="post_status" value="draft"><small class="label-text">Draft</small>
               </label>
            </div>
         </div>
         <button @if(Auth::user()->level=='admin' || Auth::user()->id==$edit->author->id) name="save" value="@if(empty($edit))add @else {{enc64($edit->post_id)}} @endif" type="submit" data-toggle="tooltip" title="Simpan Perubahan" @else type="button"  onclick="alert('Anda bukan pemilik konten ini!')" @endif class="btn btn-md btn-outline-primary w-100 add">SIMPAN</button><br><br>
      </div>
   </div>
</form>
@if($edit->mime_type != 'html')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@include('admin.layout.summernote')
@endif
<script type="text/javascript">
   function readFile(input) {
     const allow = ['gif','png','jpeg','jpg','zip','docx','doc','rar','pdf','xlsx','xls'];
     var ext = input.value.replace(/^.*\./, '');
     if(!allow.includes(ext)){
       alert("Format didukung : gif,png,jpeg,jpg,zip,docx,doc,rar,pdf,xlsx,xls");
       input.value='';
     }
   }
function delloop(path){
  var url = "{{admin_url(get_post_type().'/loop')}}";
     $.get( "ajax/test.html", function( data ) {
  $( ".result" ).html( data );
  alert( "Load was performed." );
});
   }
   function exeurl(url){
   $.get("{{url(admin_path().'/unlink?link=')}}"+url, function(data, status){
      
     notif("File Berhasil Dihapus","success");


       setTimeout(() => {
         location.reload();
 }, "1000")


 });
 }
</script>
@endsection
