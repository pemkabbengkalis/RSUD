<form class="" action="<?php echo e(url('response')); ?>" method="post">
  <?php echo csrf_field(); ?>
<div class="row justify-content-center">
  <?php $__currentLoopData = array('puas','tidak_puas'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <div class="col-lg-3 col-3 text-center">
    <?php if(request()->cookie('respon')): ?>
    <?php if(request()->cookie('respon')==$row): ?>
  <button type="button" style="background:transparent;border:none;width:70%"><img src="<?php echo e(url('respon/'.$row.'.png')); ?>" alt="" class="w-100"></button>
  <?php else: ?>
  <button style="background:transparent;border:none;width:70%" type="button"><img src="<?php echo e(url('respon/'.$row.'.png')); ?>" alt="" class="w-100" style="filter: grayscale(100%);"></button>
  <?php endif; ?>
  <?php else: ?>
  <button style="background:transparent;border:none;width:70%" name="opsi" value="<?php echo e($row); ?>"><img src="<?php echo e(url('respon/'.$row.'.png')); ?>" alt="" class="w-100"></button>
  <?php endif; ?>
  </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
</form>
<?php /**PATH C:\laragon\www\cmsv2\app\View/emot.blade.php ENDPATH**/ ?>