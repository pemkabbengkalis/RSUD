<br>
<h3 class="mb-6"> <i class="fa fa-comments" aria-hidden="true"></i> Komentar Pembaca</h3>
<div class="row">
  <div class="col-lg-12">
    @if(count($com)==0)
    <center style="color:red">"Belum ada komentar, Jadilah yang pertama !"</center>
    @endif
<ul style="margin:0;padding:0;list-style:none">
  @foreach($com as $row)
  <li style="font-size:small;background:#fff;border-radius:10px 10px 10px 0; margin-bottom:4px;padding:10px;border:1px solid #ccc">
    <img src="{{url('avatar.png')}}" style="float:left;margin-right:5px;padding-bottom:10px;height:50px;width:50px"><b>{{$row->name}}</b> <small class="text-muted">pada {{tglindo($row->created_at)}}</small><br>{!!$row->content!!}</li>
  @endforeach
</ul>
{{$com->links('vendor.pagination.bootstrap-5')}}
</div>
</div>
<br>
<h5>Tulis Komentar</h5>
@if(Session::has('success'))
<div class="alert alert-success">
Komentar Berhasil Dikirim
</div>
@endif
<form class="" action="{{URL::full()}}" method="post">
  @csrf
  <div class="form-group row">
    <div class="col-lg-4">
      <small>Nama</small>
      <input required type="text" class="form-control w-100 d-block" name="name" value="" placeholder="eg: John">
    </div>
    <div class="col-lg-4">
      <small>Tautan Profile</small>
      <input type="text" class="form-control w-100 d-block"  name="link"  value="" placeholder="eg : fb.com/john ">
    </div>
    <div class="col-lg-4">
      <small>Email</small>

      <input type="text" class="form-control w-100 d-block"" name="email" value="" placeholder="eg: john@gmail.com">
    </div>
  </div>
  <br>
  <div class="form-group">
    <textarea required name="content" class="form-control" rows="3" cols="80" placeholder="eg: Content is great and awesome"></textarea>
  </div>
  <div class="form-group text-right pt-3">
    <button  class="btn btn-md btn-primary " name="submit_comment" value="true">Kirim Komentar</button>
  </div>
</form>
<br><br>