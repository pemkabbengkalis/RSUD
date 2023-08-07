@extends('e-surat.layout',['title'=>'Formulir '.$jenis->post_title])
@section('content')
<div class="row">
<div class="col-12">

<a href="{{url('/')}}" class="btn btn-danger btn-sm"><i class="fa fa-undo" aria-hidden="true"></i> Kembali</a><br><br>
</div>
  @if(session()->has('success') || request('tesem'))
  <div class="col-lg-12">

  <p class="alert alert-success" style="font-size:20px">Permohonan berhasil dibuat dengan kode registrasi : <b>{{session('success') ?? null}}</b> silahkan catat kode ini untuk kebutuhan melihat status permohonan dan pengambilan berkas pada kantor lurah. Terima kasih</p>
  @if(request('tesem'))
  <form action="{{URL::full()}}" method="post">
    @csrf
  <center><h5>Bagaimana tingkat kepuasan layanan yang anda dapatkan ?</h5>
<input type="hidden" value="" name="kepuasan">
<input type="hidden" value="" name="layanan">
@foreach(['sangat_puas','biasa_saja','tidak_puas'] as $r)
<figure class="emot" style="display:inline-block;cursor:pointer" onclick="$('input[name=\'kepuasan\']').val('{{$r}}');$('.emot').hide();$('.saran').show();" >
  <img height="90" style="padding:0 20px"  src="{{asset('emot/'.$r.'.png')}}" alt="Trulli">
  <figcaption><b>{{Str::headline($r)}}</b></figcaption>
</figure>

@endforeach
<p class="saran" style="display:none">
  <label for="">Tuliskan saran anda </label>
  <textarea placeholder="Tulis saran anda terhadap layanan ini" name="saran" class="form-control" id="" cols="3" rows="2"></textarea><br>
  <button class="btn btn-md btn-primary">KIRIM</button>
</p>
</center>
</form>

  @endif
  </div>
  @endif

  @if(_field($jenis,'status_layanan')=='Aktif')
        <div class="col-md-12 order-md-1" @if(session()->has('success')) style="display:none" @endif>
        <div class="alert alert-warning alert-dismissible fade show" role="alert" style="border:3px solid #856404;padding-right:0">
      <b>Perhatian !</b>
      <ul style="margin:0;padding:0 20px">
      
        <li>
        Untuk mempermudah saat proses <b>UPLOAD</b> Dokumen, disarankan untuk mempersiapkan Dokumen /Foto / hasil scan Dokumen terlebih dahulu.
      </li>
      <li>Dokumen hanya bisa Diupload dalam bentuk format <b>.PDF</b>, <b>.JPG</b> atau <b>.PNG</b></li>
    <li>Mohon untuk tidak mengirimkan foto/hasil scan Dokumen yang buram.</li>
    <li>Pastikan Nomor Whatsapp pemohon aktif agar mempermudah pemberitahuan dari kami terkait permohonan yang di ajukan.</li>
    <li>Kami tidak memproses Data/Dokumen yang kurang atau tidak sesuai dengan ketentuan.</li>
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
      </div>
          <div class="alert alert-info" style="border-left:5px solid lightblue">Silahkan lengkapi kolom dibawah ini dengan data anda yang benar atau Baca Persyaratan terlebih dahulu <a href="javascript:void(0)" onclick="$('.modal').modal('show')"><b>Disini</b></a></div>
          <form enctype="multipart/form-data" class="needs-validation" style="background:#f5f5f5;border:3px dashed #777;border-radius:10px; padding:15px 10px" method="post" action="{{URL::full()}}" novalidate>
            @csrf
            <div class="row">
            <div class="col-12">
            <h5 class="mb-3 pb-3" style="color:#444;border-bottom:3px dashed #777"><center>Formulir Permohonan<br> <b>{{$jenis->post_title}}</b></center></h5>
              <h6 style="border-bottom:2px dotted #111">Data Pemohon</h6>
</div>

                @foreach($kolom as $r)
              @if(in_array($r[1],['break','array']))

              @elseif(is_array($r[1]))
              @if($r[0] == 'RW')
              
     
              <div class="col-md-6  col-6">
                <small  class="text-muted" for="firstName">{{$r[0]}} {{$rukun}}</small>
                <select name="{{underscore($r[0])}}" class="form-control " required onchange="if(this.value){$('.rt').load('{{url('checkrt')}}/'+this.value);}">
                    <option value="">-pilih-</option>
                    @foreach($r[1] as $t)
                    <option value="{{$t}}">{{$t}}</option>
                    @endforeach
                </select>
              </div>
              @elseif($r[0] == 'RT')
              <div class="col-md-6 col-6">
                <small class="text-muted" for="firstName">{{$r[0]}} {{$rukun}}</small>
                <select name="{{underscore($r[0])}}" class="form-control rt " required>
                    <option value="">-pilih-</option>
                    
                </select>
              </div>
              @else
            
            @endif
                @else
              <div class="col-md-12">
                <small for="firstName"  class="text-muted">{{$r[0]}}</small>
                <input  @if(_us($r[0]) == 'nik_pemohon') onchange="if(this.value.length < 16 || this.value.length > 16){ alert('NIK haru 16 digit');this.value='';this.focus();}" @endif @if(_us($r[0]) == 'nomor_telp_atau_wa_pemohon') maxlength="13" onchange="if(!nohp(this.value) || this.value.length < 11 || this.value.length > 13){ alert('No Telp atau Wa tidak valid');this.value='';this.focus();}" @endif 
                @if($r[1]=='number')  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" @endif type="{{$r[1]}}" class="form-control " placeholder="Masukkan {{$r[0]}}" name="{{underscore($r[0])}}" required>
              
              </div>
              @endif
              @endforeach
      
            @foreach(collect(_loop($jenis))->sortBy('sort') as $r)
            @if($r->jenis=='Break')
            @if($r->kolom)
            <div class="col-12  mt-3">
            <h6 for="" style="border-bottom:2px dotted #111">{{$r->kolom}} {!!$r->deskripsi ? '(<small  class="text-danger">'.$r->deskripsi.'</small>)' :''!!}</h6>
            
</div>
@else 
<div class="col-12">
  <hr class="py-0 mt-4 mt-0">
</div>
@endif
            @elseif($r->jenis=='Time' || $r->jenis=='Text' || $r->jenis=='Date' || $r->jenis=='Number')
            <div class="col-md-6 col-12">
                <small class="text-muted" for="firstName">{{$r->kolom}} {!!$r->deskripsi ? '<i class="text-warning">(?) '.$r->deskripsi.'</i>' :''!!}</small>
                <input  type="{{$r->jenis}}" @if($r->jenis=='Number') oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" @endif class="form-control " placeholder="Masukkan {{$r->kolom}}" name="{{underscore($r->kolom)}}" {{$r->validasi=='Iya' ? 'required':''}}>
          
              </div>
            @elseif($r->jenis=='File')
            <div class="col-md-6 col-12">
                <small class="text-muted" for="firstName">{{$r->kolom}} {!!$r->deskripsi ? '<i class="text-warning">(?) '.$r->deskripsi.'</i>' :''!!}</small>
                <input onchange="fileselect('{{underscore($r->kolom)}}')" {{$r->validasi=='Iya' ? 'required':''}} type="{{$r->jenis}}" class="form-control " id="{{underscore($r->kolom)}}" name="{{underscore($r->kolom)}}">
              </div>
              @elseif($r->jenis=='Option')
            <div class="col-md-6 col-12 ">
            <small for="firstName" class="text-muted">{{$r->kolom}}</small>

              <select {{$r->validasi=='Iya' ? 'required':''}} name="{{underscore($r->kolom)}}" class="form-control ">
                <option value="">--pilih--</option>
                @foreach(explode(',',$r->deskripsi) as $d)
                <option value="{{$d}}">{{$d}}</option>
                @endforeach
              </select>
</div>
@elseif($r->jenis=='Array')
<style>
  @media only screen and (max-width: 800px) {
  td {
    min-width:200px
  }
  
}
</style>
            <div class="col-md-12 col-12">
              <center><span class="scr d-lg-none d-sm-block text-warning"><i class="fa fa-angle-left"></i> <i class="fa fa-angle-left"></i> <i class="fa fa-angle-left"></i> <i class="fa fa-angle-left"></i> <i class="fa fa-angle-left"></i> <i class="fa fa-angle-left"></i> Geser  <i class="fa fa-angle-right"></i> <i class="fa fa-angle-right"></i> <i class="fa fa-angle-right"></i> <i class="fa fa-angle-right"></i> <i class="fa fa-angle-right"></i> <i class="fa fa-angle-right"></i> <i class="fa fa-angle-right"></i> <i class="fa fa-angle-right"></i>  <br></span></center>
              <div class="table-responsive">
              <table class="table table-bordered" style="font-size:small;width:100%">
                <thead>
                  <tr>
            @foreach(json_decode($r->deskripsi) as $ar)
            <th >{{Str::remove($r->kolom,Str::headline($ar->field))}}</th>
            @endforeach
            </tr>
            </thead>
            <tbody class="coldata">
              <tr>
              @foreach(json_decode($r->deskripsi) as $ar)
              <td >
                @if(Str::contains($ar->type,','))
                <select name="{{$ar->field}}[]" class="form-control form-control-sm">
                    <option value="">-pilih-</option>
                    @foreach(explode(',',$ar->type) as $jd)
                    <option value="{{$jd}}">{{$jd}}</option>
                    @endforeach
                </select>
                @else
             <input type="{{$ar->type}}" placeholder="Entri {{Str::remove($r->kolom,Str::headline($ar->field))}}" name="{{$ar->field}}[]" class="form-control form-control-sm">
             @endif
           </td>
            @endforeach
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="{{count(json_decode($r->deskripsi))}}" > <button type="button" class="btn btn-sm btn-warning" onclick="$('.coldata tr.nw:last').remove();"> <i class="fa fa-trash" aria-hidden="true"></i> </button> <button type="button" class="btn btn-sm btn-info" onclick="$('.coldata').append('<tr class=\'nw\'>'+ $('.addcol').html()+'</tr>');$('.coldata tr.nw .input').removeAttr('disabled');"> <i class="fa fa-plus" aria-hidden="true"></i> </button></td>
              </tr>
              <tr style="display:none" class="addcol">
              
              @foreach(json_decode($r->deskripsi) as $ar)
              <td>
              @if(Str::contains($ar->type,','))
                <select disabled name="{{$ar->field}}[]" class="form-control form-control-sm input">
                    <option value="">-pilih-</option>
                    @foreach(explode(',',$ar->type) as $jd)
                    <option value="{{$jd}}">{{$jd}}</option>
                    @endforeach
                </select>
                @else
             <input placeholder="Entri {{Str::remove($r->kolom,Str::headline($ar->field))}}" type="{{$ar->type}}" disabled name="{{$ar->field}}[]" class="form-control form-control-sm input">
             @endif
           </td>
            @endforeach
</tr>
            </tfoot>
            </table>
            </div>
            </div>
            @else
            @endif
            @endforeach
            </div>

           
       
            <hr class="mb-4">
            <button class="btn btn-primary btn-md btn-block btn-kirim" onclick="if(confirm('Apakah anda sudah yakin mengisi semua data dengan benar ?')){this.submit()}" type="submit" name="proses" value="true">Kirim Permohonan <i class="fa fa-envelope" aria-hidden="true"></i> </button>
          </form>
          <br>
   
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

    const compressImage = async (file, { quality = 1, type = file.type }) => {
        // Get as image data
        const imageBitmap = await createImageBitmap(file);

        // Draw to canvas
        const canvas = document.createElement('canvas');
        canvas.width = imageBitmap.width;
        canvas.height = imageBitmap.height;
        const ctx = canvas.getContext('2d');
        // const [newWidth, newHeight] = 1000, 1000);
        ctx.drawImage(imageBitmap, 0, 0);

        // Turn into Blob
        const blob = await new Promise((resolve) =>
            canvas.toBlob(resolve, type, quality)
        );

        // Turn Blob into File
        return new File([blob], file.name, {
            type: blob.type,
        });
    };

    // Get the selected file from the file input
    
    const fileselect = async (par)=>{
        // Get the files
        const e = document.querySelector('#'+par);
        var fil =e.value;
     if(fil!='')
     {
           var checkimg = fil.toLowerCase();
          if (!checkimg.match(/(\.jpg|\.png|\.JPG|\.PNG|\.PDF|\.pdf)$/)){ // validation of file extension using regular expression before file upload
            e.value='';
              alert('File hanya mendukuing format gambar JPG , PNG dan PDF');
              return false;
           }
      }
      const { files } = e;

        // No files selected

        // We'll store the files in this data transfer object
        const dataTransfer = new DataTransfer();

        // For every file in the files list
        for (const file of files) {
            // We don't have to compress files that aren't images
            if (!file.type.startsWith('image')) {
                // Ignore this file, but do add it to our result
                dataTransfer.items.add(file);
                continue;
            }

            // We compress the file by 50%
            const compressedFile = await compressImage(file, {
                quality: 0.3,
                type: 'image/jpeg',
            });

            // Save back the compressed file instead of the original file
            dataTransfer.items.add(compressedFile);
        }

        // Set value of the file input to our new files list
        e.files = dataTransfer.files;
        // alert(e.files);
    };
</script>
        @include('e-surat.sizetype')
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Persyaratan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!!$jenis->post_content!!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Tutup</button>
     
      </div>
    </div>
  </div>
</div>
        @else 
        <div class="col-12">
       
        <div class="alert alert-warning">Mohon maaf, layanan ini masih dalam pengembangan</div>
      
        </div>
        @endif
      </div>
      @endsection