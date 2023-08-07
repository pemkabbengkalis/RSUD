<?php $__env->startSection('content'); ?>
<div class="row">
<div class="col-lg-12"><h3 style="font-weight:normal"> <i class="fa fa-tags" aria-hidden="true"></i><?php echo e(get_module_info('title_crud')); ?> <div class="pull-right"><?php if(is_admin()): ?><a href="javascript:void(0)" onclick="$('input[type=text]' ).val('');$('textarea').val('');$('.save').val('add');$('.modtitle').html('Tambah');$('.modal').modal('show')" class="btn btn-outline-primary btn-sm "> <i class="fa fa-plus" aria-hidden></i> Tambah</a><?php endif; ?> 
 <a href="<?php echo e(admin_url(get_post_type())); ?>" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" title="Kembali Ke Index Data"> <i class="fa fa-undo" aria-hidden></i> Kembali</a></div></h3>
  <br>
<table class="table table-hover table-bordered dtclient" id="sampleTable">
<thead>
  <tr style="background:#f7f7f7">
    <th width="2%">No</th>
    <th>Urutan</th>
    <th>Nama</th>
    <th>Keterangan</th>
    <th>Jumlah Konten</th>
    <th>Status</th>
    <th width="18%">Link</th>
    <?php if(is_admin()): ?><th width="40px">Aksi</th><?php endif; ?>
  </tr>
</thead>
<tbody style="background:#fff">

<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
  <td class="text-center"><?php echo e($k+1); ?></td>
  <td class="text-center"><?php echo e($row->sort); ?></td>
  <td ><?php echo e($row->name); ?></td>
  <td><?php echo e($row->description ?? '__'); ?></td>
  <td class="text-center"><?php echo e($row->post->count()); ?></td>
  <td class="text-center" title="Klik untuk mengganti status"><a href="<?php if(Auth::user()->level=='admin'): ?><?php echo e(URL::current().'?id='.enc64($row->id).'&status='.$row->status); ?><?php else: ?> # <?php endif; ?>"><?php echo $row->status =='1' ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-warning">Draft</span>'; ?></a></td>
  <td class="text-center"> <a title="Lihat Isi Kategori di tampilan web" href="<?php echo e(url($row->url)); ?>" target="_blank" class="btn btn-sm btn-outline-success"> Kunjungi </a>  <span title="Salin URL" data-copy="<?php echo e(url($row->url)); ?>" target="_blank" class="btn btn-sm btn-outline-info pointer copy"> <i class="fa fa-copy" aria-hidden></i> </span> </td>
  <?php if(is_admin()): ?><td class="text-center"><a href="javascript::void(0)" onclick="$('.save').val('<?php echo e(enc64($row->id)); ?>');$('.modtitle').html('Edit');$('.group_name').val('<?php echo e($row->name); ?>');$('.sort').val('<?php echo e($row->sort); ?>');$('.group_url').val('<?php echo e($row->url); ?>');$('.group_description').val('<?php echo e($row->description); ?>');$('.modal').modal('show')" title="Edit"><i class="fa fa-edit"></i></a> &nbsp;<a  title="Hapus" <?php if($row->post->count()==0): ?>onclick="deleteAlert('<?php echo e(admin_url(get_post_type().'/group/delete/'.enc64($row->id))); ?>')" <?php else: ?> onclick="alert('Kategori Tidak Bisa Dihapus, Memiliki Konten Yang terkait')" <?php endif; ?> href="javascript:void(0)" class="text-danger" ><i class="fa fa-trash"></i></a></td><?php endif; ?>
</tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

</table>
</div>
</div>
<div class="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span class="modtitle"></span> <?php echo e(get_module_info('title_crud')); ?></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <form class="" action="<?php echo e(URL::full()); ?>" method="post">
        <?php echo csrf_field(); ?>
      <div class="modal-body">
          <div class="form-group">
            <label for="">Nama Kategori</label>
            <input type="text" class="form-control group_name" name="name" placeholder="Masukkan Nama Kategori" value="">
          </div>
          <div class="form-group">
            <label for="">Urutan</label>
            <input oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" type="number" class="form-control sort" name="sort" placeholder="Masukkan Nama Kategori" value="">
          </div>
          <div class="form-group">
            <label for="">Group Url</label>
            <input type="text" class="form-control group_url" name="" placeholder="(Otomatis)" value="" disabled>
          </div>
          <div class="form-group">
            <label for="">Keterangan</label>
            <textarea type="text" class="form-control group_description" name="description" placeholder="Masukkan Keterangan Kategori"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary save" type="submit" name="save" value="">Simpan</button>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
      </div>
    </form>

    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.app',['title'=>get_module_info('title_crud')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\cmsv2\app\View/admin/group.blade.php ENDPATH**/ ?>