<div class="page-content">
        <!-- Breadcrumb  row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="javascript:void(0);">Home</a></li>
                    <li>SAKIP</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb  row END -->
        <!-- contact area -->
        <div class="container">
            <!-- 404 Page -->
			<div class="section-content">
                <div class="row">
                    <div class="col-lg-12">
                    <div class="section-head text-center mt-5">
                        <h2 class="text-uppercase"><?php echo e(get_post_type($post_type)); ?></h2>
                        <div class="dez-separator-outer ">
                            <div class="dez-separator bg-primary style-skew"></div>
                        </div>
                    </div>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
<div class="table-responsive">
<table id="myTable" class="table table-bordered table-striped" style="width:100%">
<thead>
  <tr>
    <td>No</td>
    <td>Nama Berkas</td>
    <td>Ukuran</td>
    <td>Format</td>
    <td>Link</td>
  </tr>
</thead>
<tbody>
<?php 
$no = 0;
?>
<?php $__currentLoopData = $post->index('download'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($no+1); ?></td>
    <td><?php echo e($row->post_title); ?></td>
    <td><?php echo e(size(_field($row,'file')) ?? 0); ?></td>
    <td><?php echo e(Str::upper(get_ext(_field($row,'file')))); ?></td>
    <td><a class="btn btn-info" href="<?php echo e(url(_field($row,'file'))); ?>"> <i class="fa fa-download" aria-hidden="true"></i> </a></td>
  </tr>
<?php $no++ ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
</table>
</div>

                    </div>
                </div>
			</div>
            <!-- 404 Page END -->
        </div>
        <!-- contact area  END -->
    </div><?php /**PATH /home/kulipixe/cmsv2/templates/newzona/sakip/index.blade.php ENDPATH**/ ?>