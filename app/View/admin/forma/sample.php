@extends('admin.layout.app',['title'=>get_module_info('title_crud')])
@section('content')
<form class="editor-form" action="{{URL::full()}}" method="post" enctype="multipart/form-data">
   @csrf
   <div class="row">
      <div class="col-lg-12">
         <h3 style="font-weight:normal"> <i class="fa {{get_module_info('icon')}}" aria-hidden="true"></i> {{get_module_info('title_crud')}} <a href="{{admin_url(get_post_type())}}" class="btn btn-outline-danger btn-sm pull-right"> <i class="fa fa-undo" aria-hidden></i> Kembali</a></h3>
         <br>
         @if(!empty($edit && get_module_info('detail') && $edit->post_title))
         <div style="border-left:3px solid green" class="alert alert-success"><b>URL : </b><a title="Kunjungi URL" data-toggle="tooltip" href="{{url($edit->post_url)}}" target="_blank"><i><u>{{url($edit->post_url)}}</u></i></a> <span title="Klik Untuk Menyalin alamat URL {{get_module_info('title')}}" data-toggle="tooltip" class="pointer copy pull-right badge badge-primary" data-copy="{{url($edit->post_url)}}"><i class="fa fa-copy" aria-hidden></i> <b>Salin</b></span></div>
         @endif
      </div>
      <div class="col-lg-9">
         <div class="form-group">
         @if(get_module_info('parent') && get_module_info('parent') == 'e-surat')
         @if($edit->post_meta_description && $edit->post_meta_keyword && $edit->post_pin=='1' && $edit->mime_type)
         <button onclick="return confirm('Cetak Dokumen ?')" type="submit" name="cetak_surat" value="true" class="btn btn-success btn-sm"> <i class="fa fa-print"></i> Cetak</button> @if($edit->post_status=='publish') <button type="submit" name="kirim_pemberitahuan" onclick="return confirm('Kirim pemberitahuan pengambilan dokumen permohonan di kantor kelurahan ke pemohon ?')" value="true" class="btn btn-warning btn-sm pull-right"> <i class="fa fa-bell" aria-hidden="true"></i> Kirim Pemberitahuan</button>@endif<br><br>
         <label>Kode Registrasi</label>
         @endif
         @endif
            <input @if(get_module_info('parent') && get_module_info('parent')=='e-surat') style="border:none;background:none;padding:0;margin:0;font-size:30px;margin-top:-20px;font-weight:bold" readonly @else title="Masukkan {{get_module_info('data_title')}}" @endif required name="post_title"  type="text" value="{{$edit->post_title ?? ''}}" placeholder="Masukkan {{get_module_info('data_title')}}" class="form-control form-control-lg">
          
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
         <h6>{{get_module_info('post_parent')[0]}}</h6>
         @if(get_module_info('parent') != 'e-surat')
         <select class="form-control form-control-sm" name="post_parent">
            <option value="">--pilih--</option>
            @php $par = isset(get_module_info('post_parent')[2]) ? App\Models\Posts::where('post_type',get_module_info('post_parent')[1])->where('post_status','publish')->where('post_group',get_group_id(get_module_info('post_parent')[1],get_module_info('post_parent')[2]))->select('post_id','post_title')->get() : App\Models\Posts::where('post_type',get_module_info('post_parent')[1])->where('post_status','publish')->select('post_id','post_title')->get(); @endphp
            @foreach($par as $row)
            <option @if($edit && $edit->post_parent == $row->post_id) selected @endif value="{{$row->post_id}}">{{$row->post_title}}</option>
            @endforeach

         </select>
         @else
         <input type="hidden" name="post_parent" value="{{$edit->post_parent ?? null}}">
         <h4> <i class="fa fa-tags"></i> {{$field['jenis_pelayanan']}}</h4>
         @endif
         @endif
         @if(get_module_info('post_type') != 'lasyanan')

         @if(get_module_info('custom_field'))
         @foreach(get_module_info('custom_field') as $r)
         @if(is_array($r[1]))
         <small>{{$r[0]}}</small>
         @if(get_module_info('parent') == 'e-surat' && in_array($r[0],['RT','RW'])) 
         <input type="hidden" name="{{underscore($r[0])}}" value="{{$field[underscore($r[0])]}}">
         @endif  
         <select  @if(get_module_info('parent') == 'e-surat' && in_array($r[0],['RT','RW'])) disabled @endif  class="form-control form-control-sm" name="{{underscore($r[0])}}">
            <option value="">--pilih--</option>
            @foreach($r[1] as $i)
            <option {{(!empty($field) && isset($field[underscore($r[0])]) && $field[underscore($r[0])]==$i)? 'selected':'' }} value="{{$i}}">{{$i}}</option>
            @endforeach
         </select>
         @elseif($r[1]=='file')
         <small for="">{{$r[0]}}</small>
         <input @if($field && isset($field[underscore($r[0])]) && $field[underscore($r[0])] && file_exists(public_path($field[underscore($r[0])]))) disabled @else title="Pilih berkas jika diganti" @endif onchange="readFile(this);" @if(!empty($field[underscore($r[0])]))  data-toggle="tooltip" @endif value="{{$field[underscore($r[0])] ?? ''}}" class="form-control-file form-control form-control-sm" name="{{underscore($r[0])}}" type="file" placeholder="Masukkan {{$r[0]}}">

         <input value="{{$field && isset($field[underscore($r[0])]) && file_exists(public_path($field[underscore($r[0])])) ? $field[underscore($r[0])] : null }}" name="old_{{underscore($r[0])}}" type="hidden">
         @if($field && isset($field[underscore($r[0])]) && $field[underscore($r[0])] && file_exists(public_path($field[underscore($r[0])])))<small> <a class="badge badge-primary" href="{{asset($field[underscore($r[0])])}}" >Preview</a> <i style="cursor:pointer" onclick="if(confirm('Hapus file ?')){exeurl('{{$field[underscore($r[0])]}}')}" class="fa fa-trash text-danger"></i></small> <br> @endif
         @elseif($r[1]=='break')
         <br>
         <h6 for="" style="border-bottom:1px dashed #000">{{$r[0]}}</h6>
         @elseif($r[1]=='array')
         @if(get_module_info('parent')=='e-surat')
         @include('e-surat.form-admin')
         @endif
         <input type="hidden" value="{{json_encode($field[underscore($r[0])]) ?? ''}}" name="{{underscore($r[0])}}">
         @else
         <small for="">{{$r[0]}}</small>
         <input @if($r[1]=='number') oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" @endif value="{{$field[underscore($r[0])] ?? ''}}" class="form-control form-control-sm" name="{{underscore($r[0])}}" type="{{$r[1]=='number'?'text':$r[1]}}" placeholder="Entri Data {{$r[0]}}">
         @endif
         @endforeach
         @endif
         @endif



         @if((get_module_info('looping') && get_post_type() !='halaman') || (get_post_type() =='halaman' && $edit->mime_type=='html'))
         <br>
         <h6 style="border-bottom:1px dashed #000;font-weight:normal"><b>{{get_module_info('looping')}}</b> <span class="text-muted pull-right">{{get_module_info('looping_for')}}</span> </h6>

         @if(get_module_info('post_type') != 'menu')
         @if(get_module_info('post_type') == 'lasyanan')
         @include('admin.hasil-skm')
         @else
         @if(get_module_info('parent') == 'e-surat')
         @if($edit->post_status == 'publish')
         @include('admin.looping-data')
         @endif
         @else
         @include('admin.looping-data')

         @endif
         
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
         @if(get_module_info('parent') == 'e-surat')
         <small for="">Catatan {!!help("Berikan catatan terkait data permohonan")!!} </small>
         <textarea placeholder="Tulis Catatan" type="text" class="form-control form-control-sm" name="post_content">{{$edit->post_content ?? ''}}</textarea>
         <small for="">Tanggal Cetak  {!!help("Masukkan Tanggal Cetak Permohonan")!!}</small>
         <input required type="date" class="form-control form-control-sm" name="post_meta_description" value="{{$edit->post_meta_description ?? ''}}">
         <small for="">Nomor Surat  {!!help("Nomor Surat")!!}</small>
         <input required placeholder="Masukkan Nomor" type="text" class="form-control form-control-sm" name="post_meta_keyword" value="{{$edit->post_meta_keyword ?? ''}}">
         <small for="">Penandatangan  {!!help("Pejabat Penandatangan Surat")!!}</small>
         @php $pjb = new \App\Models\PublicPost; @endphp
         <select name="mime_type" class="form-control" required>
            <option value="">--pilih--</option>
            @foreach($pjb->index_by_group_name('aparatur-kelurahan','pegawai') as $pj)
            @if(_field($pj,'penandatangan')=='Iya')
            <option value="{{$pj->post_id}}" {{$edit && $edit->mime_type == $pj->post_id ? 'selected':''}}>{{_field($pj,'nama_jabatan')}} - {{$pj->post_title}}</option>
            @endif
            @endforeach
         </select>
         <br>
         <div class="form-group form-inline">
            <div class="animated-radio-button">
               <label>
               <input required {{($edit && $edit->post_pin == '1')? 'checked=checked':''}} required type="radio" name="post_pin" value="1"><small class="label-text"> Valid</small>
               </label>
            </div>
            &nbsp;&nbsp;&nbsp;
            <div class="animated-radio-button">
               <label>
               <input required {{($edit && $edit->post_pin == '0')? 'checked=checked':''}} required type="radio" name="post_pin" value="0"><small class="label-text">Tidak Valid</small>
               </label>
            </div>
         </div>
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
         <select required class="form-control form-control-sm" id="demoSelect" multiple="" name="post_group[]">
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
         <div class="animated-checkbox">
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
         <button @if(Auth::user()->level=='admin' || Auth::user()->id==$edit->author) name="save" onclick="return confirm('Simpan perubahan ?')" value="@if(empty($edit))add @else {{enc64($edit->post_id)}} @endif" type="submit" @else type="button"  onclick="alert('Anda bukan pemilik konten ini!')" @endif class="btn btn-md btn-outline-primary w-100 add">SIMPAN</button><br><br>
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
