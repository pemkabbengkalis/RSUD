<?php $__env->startSection('content'); ?>
<!-- <link href="https://coderthemes.com/adminox/layouts/vertical/assets/css/icons.min.css" rel="stylesheet" type="text/css" /> -->
<div class="row">
<div class="col-lg-12"><h3 style="font-weight:normal"> <i class="fa fa-tachometer"></i> Dashboard</h3>
  <br>
  <div class="row">
    <?php
    $type = !is_admin() ? collect(get_module(true))->where('detail',true)->where('operator',true) : collect(get_module(true))->where('detail',true);

    $posts = DB::table('posts')->where('post_status','publish')->whereIn('post_type',$type->pluck('name'))->select('post_type')->get();
    ?>
    <?php $__currentLoopData = $type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div title="Klik untuk selengkapnya" class="pointer col-md-6 col-lg-4 " onclick="location.href='<?php echo e(admin_url($row['name'])); ?>'">
            <div class="widget-small primary coloured-icon"><i class="icon fa <?php echo e($row['icon']); ?> fa-3x"></i>
              <div class="info">
                <h4><?php echo e($row['title']); ?></h4>
                <p><b><?php echo e(count(collect($posts->where('post_type',$row['name'])))); ?></b></p>
              </div>
            </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
</div>
<div class="col-lg-8 mb-3">
  <div class="card" style="padding:15px">
  <h4 for="" style="margin-bottom:20px"><i class="fa fa-globe" aria-hidden="true"></i> Terakhir Dipublikasi</h4>
  <?php $type = collect(get_module(true))->where('detail',true)->where('name','!=','media')->pluck('name');
    ?>
  <div class="table-responsive"> <table class="table" style="font-size:small">
  <thead><tr>
    <th>Konten</th>
    <th>Waktu</th>
    <th>Judul</th>
  </tr></thead>
  <tbody>
  <?php $__currentLoopData = App\Models\Post::with('author')->latest('created_at')->wherein('post_type',$type)->wherePostStatus('publish')->limit(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <tr>
    <td><?php echo e(Str::title($r->post_type)); ?></td>
    <td><code><?php echo e(time_ago($r->created_at)); ?></code></td>
    <td><a href="<?php echo e(url(admin_path().'/'.$r->post_type.'/edit/'.enc64($r->post_id))); ?>"><?php echo e($r->post_title); ?></a>  <i class="text-muted">oleh <?php echo e($r->author->name); ?></i></td>
   </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
  </table>
  </div>
</div>
</div>
<div class="col-lg-4">
  <div class="card" style="padding:15px">
  <h4 for="" style="margin-bottom:20px"> <i class="fa fa-bar-chart" aria-hidden="true"></i> Grafik Pengunjung Mingguan</h4>
  <?php echo $__env->make('admin.visitor-chart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
</div>
<div class="col-lg-12 mt-3">
  <div class="card" style="padding:15px">
  <h4 for=""  style="margin-bottom:20px"> <i class="fa fa-info" aria-hidden="true"></i> Rincian Trafik<span class="pull-right"><small>Pilih </small> <input max="<?php echo e(date('Y-m-d')); ?>" value="<?php echo e(request('timevisit') ?? date('Y-m-d')); ?>" onchange="if(this.value) location.href='<?php echo e(url()->current().'?timevisit='); ?>'+this.value" style="width:120px" type="date" class="form-control-sm " ></span></h4>
  
  <div class="table-responsive"> <table class="table datat" style="font-size:small;width:100%">
  <thead><tr>
    <th width="2%">No</th>
    <th width="18%">Time</th>
    <th width="15%">Page</th>
    <th width="15%">Reference</th>
    <th width="20%">IP</th>
    <th width="10%">Browser</th>
    <th width="10%">Device</th>
    <th width="10%">OS</th>
  </tr></thead>
  <tbody>

  </tbody>
  </table>
  </div>

</div>
</div>
<script type="text/javascript">
          window.addEventListener('DOMContentLoaded', function() {            
          // var post_type = "<?php echo e(get_post_type()); ?>";
          var table = $('.datat').DataTable({
        processing: true,
        serverSide: true,
        ajax: "<?php echo e(url(admin_path().'/visitor'.str_replace('/'.admin_path().'/dashboard','',request()->getRequestUri()))); ?>",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false},
            {data: 'time', name: 'time'},
            {data: 'page', name: 'page'},
            {data: 'reference', name: 'reference'},
            {data: 'ip_location', name: 'ip_location'},
            {data: 'browser', name: 'browser'},
            {data: 'device', name: 'device'},
            {data: 'os', name: 'os'},
        ]
    });

          });
    </script>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout.app',['title'=>'Dashboard'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/kulipixe/cmsv2/app/View/admin/dashboard.blade.php ENDPATH**/ ?>