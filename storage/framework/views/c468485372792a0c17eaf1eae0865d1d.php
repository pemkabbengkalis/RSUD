<style type="text/css">
body{overflow-x:hidden;}

.dd { position: relative; display: block; margin: 0; padding: 0; max-width: 100vw; list-style: none; font-size: 13px; line-height: 20px; }

.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }

.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

.dd-handle { display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
background: #fafafa;
background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
background:         linear-gradient(top, #fafafa 0%, #eee 100%);
-webkit-border-radius: 3px;
      border-radius: 3px;
box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover { color: #2ea8e5; background: #fff; }

.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }

.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                   -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                        linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
background-size: 60px 60px;
background-position: 0 0, 30px 30px;
}

.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
-webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
      box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}

/**
* Nestable Extras
*/

.nestable-lists { display: block; clear: both; padding: 30px 0; width: 100%; border: 0; border-top: 2px solid #ddd; border-bottom: 2px solid #ddd; }

#nestable-menu { padding: 0; margin: 20px 0; }

#nestable-output,
#nestable2-output { width: 100%; height: 7em; font-size: 0.75em; line-height: 1.333333em; font-family: Consolas, monospace; padding: 5px; box-sizing: border-box; -moz-box-sizing: border-box; }

#nestable2 .dd-handle {
color: #fff;
border: 1px solid #999;
background: #bbb;
background: -webkit-linear-gradient(top, #bbb 0%, #999 100%);
background:    -moz-linear-gradient(top, #bbb 0%, #999 100%);
background:         linear-gradient(top, #bbb 0%, #999 100%);
}
#nestable2 .dd-handle:hover { background: #bbb; }
#nestable2 .dd-item > button:before { color: #fff; }

@media only screen and (min-width: 700px) {

.dd { float: left; width: 100%; }
.dd + .dd { margin-left: 2%; }

}

.dd-hover > .dd-handle { background: #2ea8e5 !important; }

/**
* Nestable Draggable Handles
*/

.dd3-content { display: block; height: 30px; margin: 5px 0; padding: 5px 10px 5px 40px; color: #333; text-decoration: none; font-weight: bold; border: 1px solid #ccc;
background: #fafafa;
background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
background:         linear-gradient(top, #fafafa 0%, #eee 100%);
-webkit-border-radius: 3px;
      border-radius: 3px;
box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd3-content:hover { color: #2ea8e5; background: #fff; }

.dd-dragel > .dd3-item > .dd3-content { margin: 0; }

.dd3-item > button { margin-left: 30px; }

.dd3-handle { position: absolute; margin: 0; left: 0; top: 0; cursor: pointer; width: 30px; text-indent: 100%; white-space: nowrap; overflow: hidden;
border: 1px solid #aaa;
background: #ddd;
background: -webkit-linear-gradient(top, #ddd 0%, #bbb 100%);
background:    -moz-linear-gradient(top, #ddd 0%, #bbb 100%);
background:         linear-gradient(top, #ddd 0%, #bbb 100%);
border-top-right-radius: 0;
border-bottom-right-radius: 0;
}
.dd3-handle:before { content: '≡'; display: block; position: absolute; left: 0; top: 3px; width: 100%; text-align: center; text-indent: 0; color: #fff; font-size: 20px; font-weight: normal; }
.dd3-handle:hover { background: #ddd; }

/**
* Socialite
*/

.socialite { display: block; float: left; height: 35px; }

</style>
<input type="hidden" id="nestable3-output" class="form-control" name="menu_json">
<div class="row">
  <div class="col-lg-12">

<?php
function getlistmenu($menu,$menulist){
  $me = $menu;
  $m = '';
foreach (json_decode(json_encode($menulist)) as $key => $value) {
  $m .= '
  <li class="dd-item dd3-item menu-id-'.$value->id.'" data-id="'.$value->id.'">
  <input type="hidden" name="id[]" value="'.$value->id.'">
  <input type="hidden" name="parent[]" value="'.$value->parent.'">
  <input type="hidden" class="name-'.$value->id.'" name="name[]" value="'.$value->name.'">
  <input type="hidden" class="desc-'.$value->id.'" name="description[]" value="'.$value->description.'">
  <input type="hidden" class="link-'.$value->id.'" name="link[]" value="'.$value->link.'">
  <input type="hidden" class="icon-'.$value->id.'" name="icon[]" value="'.$value->icon.'">
    <div style="cursor:move" class="dd-handle dd3-handle"></div><div class="dd3-content">'.$value->name.' <i class="fa fa-angle-right" aria-hidden></i>  <code><i>'.$value->link.'</i></code><span style="float:right"><a href="javascript:void(0)" onclick="$(\'.link\').val(\''.$value->link.'\');$(\'.description\').val(\''.$value->description.'\');$(\'.name\').val(\''.$value->name.'\');$(\'.iconx\').val(\''.$value->icon.'\');$(\'#type\').val(\''.$value->id.'\');$(\'.modal\').modal(\'show\')" class="text-warning"> <i class="fa fa-edit" aria-hidden=""></i> </a> &nbsp; <a href="javascript:void(0)" onclick="del_menu(\''.$value->id.'\')" class="text-danger"> <i class="fa fa-trash" aria-hidden=""></i> </a></span></div>
    '.ceksubmenu($me,$value->id).'
  </li>
  ';
}
return $m;
}
function ceksubmenu($menu,$id){
$cek = $menu->where('parent',$id);
if(count($cek)>0){
  $m = '<ol class="dd-list">';
  $m .= getlistmenu($menu,$cek);
  $m .= '</ol>';
  return $m;
}else {
  return null;
}
}

?>
<div class="dd" id="nestable3" style="max-height:55vh;overflow:auto">
      <ol class="dd-list main-list">
        <?php $menu = collect(json_decode($looping_data,true));?>

           <?php $__currentLoopData = json_decode(json_encode($menu->where('parent',0))); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y=> $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


          <li class="dd-item dd3-item menu-id-<?php echo e($l->id); ?>" data-id="<?php echo e($l->id); ?>">
            <input  type="hidden" name="id[]" value="<?php echo e($l->id ?? null); ?>">
            <input  type="hidden" name="parent[]" value="<?php echo e($l->parent?? null); ?>">
            <input  type="hidden" class="name-<?php echo e($l->id); ?>"  name="name[]" value="<?php echo e($l->name ?? null); ?>">
            <input  type="hidden" class="desc-<?php echo e($l->id); ?>" name="description[]" value="<?php echo e($l->description ?? null); ?>">
            <input  type="hidden" class="link-<?php echo e($l->id); ?>" name="link[]" value="<?php echo e($l->link ?? null); ?>">
            <input  type="hidden" class="icon-<?php echo e($l->id); ?>" name="icon[]" value="<?php echo e($l->icon ?? null); ?>">
              <div style="cursor:move" class="dd-handle dd3-handle"></div><div class="dd3-content"><?php echo e($l->name); ?> <i class="fa fa-angle-right" aria-hidden></i> <code><i><?php echo e($l->link); ?></i></code><span style="float:right"><a href="javascript:void(0)" onclick="$('.description').val('<?php echo e($l->description); ?>');$('.link').val('<?php echo e($l->link); ?>');$('.name').val('<?php echo e($l->name); ?>');$('.iconx').val('<?php echo e($l->icon); ?>');$('#type').val('<?php echo e($l->id); ?>');$('.modal').modal('show')" class="text-warning" > <i class="fa fa-edit" aria-hidden></i> </a> &nbsp; <a href="javascript:void(0)" onclick="del_menu('<?php echo e($l->id); ?>')" class="text-danger" > <i class="fa fa-trash" aria-hidden></i> </a></span></div>
          <?php echo ceksubmenu($menu,$l->id); ?>



          </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ol>
  </div>
  <button type="button" class="btn btn-sm btn-info pull-right btnadd" onclick="$('#type').val('add');$('.modal').modal('show');" name="button"> <i class="fa fa-plus" aria-hidden></i> Baru</button>
</div>

</div>

<div class="newmenu" style="display:none">
  <?php $id = rnd(4); ?>
  <li class="dd-item dd3-item" id="dataid" data-id="<?php echo e($id); ?>">
    <input  type="hidden" id="id" name="id[]" value="<?php echo e($id); ?>">
    <input  type="hidden" id="parent" name="parent[]" value="0">
    <input  type="hidden" id="name" name="name[]" value="New Menu">
    <input  type="hidden" id="description" name="description[]" value="New Description">
    <input  type="hidden" id="link" name="link[]" value="http://linkmenu.com">
    <input  type="hidden" id="iconx" name="icon[]" value="Icon">

      <div style="cursor:move" class="dd-handle dd3-handle"></div><div class="dd3-content" id="labelname">New Menu</div>
  </li>
</div>
<div class="modal" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span class="modtitle"></span>Form</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <form class="" action="javascript:void(0)" method="post">
      <div class="modal-body">
        <div class="alert alert-info">
          Pastikan Klik Tombol Simpan untuk melakukan perubahan!
        </div>
          <div class="form-group">
            <input type="hidden" id="type" value="add">
            <label for="">Nama Menu</label>
            <input type="text" class="form-control name" name="names" placeholder="Masukkan Nama Menu" value="">
          </div>
          <div class="form-group">
            <label for="">Keterangan</label>
            <textarea  type="text" class="form-control description" name="descriptions" placeholder="Masukkan Keterangan Menu" value=""></textarea>
          </div>
          <div class="form-group">
            <label for="">Target</label>
            <input  type="text" class="form-control link" name="links" placeholder="Masukkan Link Target" value="">
          </div>
          <div class="form-group">
            <label for="">Icon</label>
            <input  type="text" class="form-control iconx" name="icons" placeholder="Masukkan Url Icon" value="-">
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary save" onclick="setmenu();$('.modal').modal('hide')" type="button" name="save" value="">Simpan</button>

      </div>
    </form>

    </div>
  </div>
</div>
<script src="<?php echo e(asset('backend/js/jquery.nestable.js')); ?>"></script>
<script>

$(document).ready(function()
{

  var updateOutput = function(e)
  {
      var list   = e.length ? e : $(e.target),
          output = list.data('output');
      if (window.JSON) {
          output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
      } else {
          output.val('JSON browser support required for this demo.');
      }
  };

  // activate Nestable for list 1

$('#nestable3').nestable({
 group: 1}
 )
.on('change', updateOutput);
  // output initial serialised data
updateOutput($('#nestable3').data('output', $('#nestable3-output')));




});
function del_menu(id){
  if(confirm('Hapus Menu ini?'))
   {
     $('.menu-id-'+id).remove();
     $('#nestable3').nestable({
      group: 1}
    ).change();
 }
}
function setmenu(){
  var name = $('.name').val();
  var desc = $('.description').val();
  var link = $('.link').val();
  var icon = $('.iconx').val();

  $('#name').val(name);
  $('#description').val(desc);
  $('#link').val(link);
  $('#iconx').val(icon);
  $('#labelname').html(name);
  var type = $('#type').val();
  if(type != 'add'){
    $('.name-'+type).val(name);
    $('.desc-'+type).val(desc);
    $('.link-'+type).val(link);
    $('.icon-'+type).val(icon);
  }else {
    $('.main-list').append($('.newmenu').html());
    $('#nestable3').nestable({
     group: 1}
   ).change();

  }

 $('.add').click();
    // output initial serialised data
}
</script>
<?php /**PATH /home/kulipixe/cmsv2/app/View/admin/list-menu.blade.php ENDPATH**/ ?>