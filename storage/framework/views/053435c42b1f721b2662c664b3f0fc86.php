<div class="page-content">
        <!-- Breadcrumb  row -->
        <div class="breadcrumb-row">
            <div class="container">
                <ul class="list-inline">
                    <li><a href="<?php echo e(url('/')); ?>">Beranda</a></li>
                    <li>Agenda</li>
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
<table id="myTable" class="table table-bordered " style="width:100%">
<thead>
  <tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Tema</th>
    <th>Aksi</th>
  </tr>
</thead>
<tbody>
<?php 
$no = 0;
?>
<?php $__currentLoopData = $index; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<tr>
    <td><?php echo e($no+1); ?></td>
    <td><?php echo e(tglindo(_field($row,'tanggal'))); ?></td>
    <td><h4><?php echo e($row->post_title); ?></h4>
    <p>Tempat : <?php echo e(_field($row,'tempat')); ?><br>
    Alamat : <?php echo e(_field($row,'Alamat')); ?><br>
    Keterangan : <?php echo $row->post_content; ?></p></td>
    <td><a href="<?php echo e(url($row->post_url)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Baca Selengkapnya</a></td>

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
    </div><?php /**PATH C:\laragon\www\cmsv2\templates/newzona/agenda/index.blade.php ENDPATH**/ ?>