<form class="" action="{{url('response')}}" method="post">
  @csrf
<div class="row justify-content-center">
  @foreach(array('puas','tidak_puas') as $row)
  <div class="col-lg-3 col-3 text-center">
    @if(request()->cookie('respon'))
    @if(request()->cookie('respon')==$row)
  <button type="button" style="background:transparent;border:none;width:70%"><img src="{{url('respon/'.$row.'.png')}}" alt="" class="w-100"></button>
  @else
  <button style="background:transparent;border:none;width:70%" type="button"><img src="{{url('respon/'.$row.'.png')}}" alt="" class="w-100" style="filter: grayscale(100%);"></button>
  @endif
  @else
  <button style="background:transparent;border:none;width:70%" name="opsi" value="{{$row}}"><img src="{{url('respon/'.$row.'.png')}}" alt="" class="w-100"></button>
  @endif
  </div>
  @endforeach
</div>
</form>
