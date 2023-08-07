<?php if(get_module_info('post_type')=='media'): ?>
<?php echo $__env->make('admin.form-media', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
<?php echo $__env->make('admin.form-default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php /**PATH /home/kulipixe/cmsv2/app/View/admin/form.blade.php ENDPATH**/ ?>