<?php $__env->startSection('content'); ?>
<form class="" action="<?php echo e(URL::full()); ?>" method="post" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
<div class="row">
<div class="col-lg-12"><h3 style="font-weight:normal;margin-bottom:20px"> <i class="fa fa-gears"></i> Pengaturan <button name="save_setting" value="true" class="btn btn-outline-primary btn-sm pull-right">  <i class="fa fa-save" aria-hidden></i> Simpan</button></h3>

  <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#home">Organisasi</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile">Situs Web</a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#keamanan">Keamanan</a></li>
                <?php if(config('module.setting')): ?>

                <?php $__currentLoopData = config('module.setting'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#<?php echo e($r['id']); ?>"><?php echo e($r['name']); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="home">
                  <?php $__currentLoopData = $org; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <small for="" class="text-muted"><?php echo e($r[0]); ?></small>
              <input required type="text" class="form-control form-control-sm" placeholder="Masukkan <?php echo e($r[0]); ?>" name="<?php echo e($r[1]); ?>" value="<?php echo e(get_option($r[1])); ?>">
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                <div class="tab-pane fade" id="profile">
                  <small>Konten Halaman Utama</small>
                  <select class="form-control form-control-sm" name="home_page">
                  <option value="">Default</option>
                  <?php $__currentLoopData = \App\Models\Post::where('post_type','halaman')->where('mime_type','html')->where('post_status','publish')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option <?php echo e(get_option('home_page')==$row->post_id ? 'selected' : ''); ?> value="<?php echo e($row->post_id); ?>">Halaman - <?php echo e($row->post_title); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                  <?php $__currentLoopData = $site; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <small for="" class="text-muted"><?php echo e($r[0]); ?></small>
              <input type="text" <?php if($r[2]=='number'): ?> oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" <?php endif; ?> class="form-control form-control-sm" placeholder="Masukkan <?php echo e($r[0]); ?>" name="<?php echo e($r[1]); ?>" value="<?php echo e(get_option($r[1])); ?>">
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <small for="" class="text-muted">Favicon (Ukuran 1:1)</small>
                  <?php if(file_exists(public_path(get_option('favicon')))): ?>
                  <br>
                  <img src="<?php echo e(asset(get_option('favicon'))); ?>" alt="" style="width:100px;padding:10px">
                  <br>
                  <?php endif; ?>
              <input type="file" class="form-control-file" name="favicon" value="">
              <small for="" class="text-muted">Logo</small>
              <?php if(file_exists(public_path(get_option('logo')))): ?>
              <br>
              <img src="<?php echo e(asset(get_option('logo'))); ?>" alt="" style="width:100px;padding:10px">
              <br>
              <br>
              <?php endif; ?>
              <input type="file" class="form-control-file" name="logo" value="">
            </div>
                <div class="tab-pane fade" id="keamanan">
              <small for="" class="text-muted">Status Maintenance</small><br>
              <input type="radio" name="site_maintenance" value="Y" <?php echo e(get_option('site_maintenance')=='Y'? 'checked':''); ?> > <small>Aktif</small>
              <input type="radio" name="site_maintenance" value="N" <?php echo e(get_option('site_maintenance')=='N'? 'checked':''); ?> > <small>Tidak Aktif</small><br>
      <small for="" class="text-muted">Path URL Login Admin</small>

              <input type="text" value="<?php echo e(get_option('admin_path')); ?>" class="form-control form-control-sm" name="admin_path" placeholder="contoh : adminpanel ,  siadmin , cpanel, weblogin dst"><br>
              <div class="alert alert-warning">Hati-hati dalam melakukan perubahan Path URL Login Admin. Path Url login admin saat ini adalah <br> <b><?php echo e(url(get_option('admin_path'))); ?></b><br>Silahkan dicatat agar ingat.</div>
            </div>
            <?php if(config('module.setting')): ?>
            <?php $__currentLoopData = config('module.setting'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tab-pane fade" id="<?php echo e($r['id']); ?>">
            <?php $__currentLoopData = $r['form']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if('file'==$row['type']): ?>
            <small for="" class="text-muted"><?php echo e($row['name']); ?></small>
            <input type="hidden" name="<?php echo e($row['field']); ?>_old" value="<?php echo e(get_option($row['field'])??null); ?>">
            <input type="file" class="form-file-sm form-control" name="<?php echo e($row['field']); ?>">
            <?php if(get_option($row['field'])): ?><a href="<?php echo e(asset(get_option($row['field']))); ?>" class="badge badge-success"><?php echo e(get_option($row['field'])); ?></a><br><?php endif; ?>
            <?php else: ?>
            <small for="" class="text-muted"><?php echo e($row['name']); ?></small>
            <input type="<?php echo e($row['type']); ?>" class="form-control form-control-sm" name="<?php echo e($row['field']); ?>" value="<?php echo e(get_option($row['field'])??null); ?>">

            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

              </div>
</div>
</div>
</form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.app',['title'=>'Pengaturan'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kulipixe/cmsv2/app/View/admin/setting.blade.php ENDPATH**/ ?>