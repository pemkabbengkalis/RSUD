<?php $__env->startSection('content'); ?>

<?php echo $__env->make(View::exists(get_view(get_view())) ? blade_path(get_view()) : blade_path(get_module_info('view_type')), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\cmsv2\app\View/master.blade.php ENDPATH**/ ?>