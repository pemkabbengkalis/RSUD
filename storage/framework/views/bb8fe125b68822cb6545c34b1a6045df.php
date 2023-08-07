
<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col-lg-12 mb-3">
  <h3 style="font-weight:normal;float:left"><i class="fa <?php echo e(get_module_info('icon')); ?>" aria-hidden="true"></i> <?php echo e(get_module_info('title_crud')); ?> 
</h3>
<div class="pull-right"><a href="<?php echo e(admin_url(get_post_type().'/create')); ?>" class="btn btn-outline-primary btn-sm"> <i class="fa fa-plus" aria-hidden></i> Tambah</a> <?php if(get_module_info('group')): ?> <a href="<?php echo e(admin_url(get_post_type().'/group')); ?>" class="btn btn-outline-dark btn-sm"> <i class="fa fa-tags" aria-hidden></i> Kategori</a> <?php endif; ?> </div>
</div>
<!-- <select name="" id="" style="width:150px;" class="form-control form-control-sm pull-left ">
  <option value="" class="">--Tindakan Centang--</option>
  <option value="" class="">Publikasikan</option>
  <option value="" class="">Masuk Draft</option>
  <option value="" class=""><font color="#fff">Tong Sampah</font></option>
  <option value="" class="">Hapus</option>
</select>&nbsp; -->
<!-- <script>
           function toggle(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source)
            checkboxes[i].checked = source.checked;
    }

        // var val = [];
        // $('.post_id:checked').each(function(i){
        //   val[i] = $(this).val();
        // });
        // if(val.length > 0){
        //   alert(val);
        // }
}

</script> -->
<div class="col-lg-12">
<div class="table-responsive">

<table class="table table-hover table-bordered datat" style="background:#f7f7f7;width:100%">
<thead style="text-transform:uppercase;color:#444">
  <tr>
    <th style="width:10px"> 
   
        <input id="chk" onclick="toggle(this);" type="checkbox">
</th>
    <th style="width:10px">NO</th>
    <?php if(get_module_info('thumbnail')): ?>
    <th style="width:55px" >Gambar</th>
    <?php endif; ?>
    <th><?php echo e(get_module_info('data_title')); ?></th>
    <?php if(get_module_info('post_parent')): ?>
    <th ><?php echo e(get_module_info('post_parent')[0]); ?></th>
    <?php endif; ?>
    <?php if(get_module_info('custom_column')): ?>
    <th><?php echo e(get_module_info('custom_column')); ?></th>
    <?php endif; ?>
    <th style="width:60px">Dibuat</th>
 
    <?php if(get_post_type()!='media'): ?><th style="width:60px">Diubah</th><?php endif; ?>
    <?php if(get_module_info('detail')): ?>
    <th  style="width:30px">Hits</th>
    <?php endif; ?>
    <th style="width:40px">Aksi</th>
  </tr>
</thead>

<tbody style="background:#fff">

</tbody>


</table>
</div>

</div>
</div>
<?php echo $__env->make('admin.datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.app',['title'=>get_module_info('title_crud')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\cmsv2\app\View/admin/index-default.blade.php ENDPATH**/ ?>