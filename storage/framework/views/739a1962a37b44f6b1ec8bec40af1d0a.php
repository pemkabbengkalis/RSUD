<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar" style="background:#1D2327;font-size:12px;" >
   <div class="app-sidebar__user" style="cursor:pointer;margin-bottom:0"  onclick="javascript:location.href=''">
      <img class="app-sidebar__user-avatar" style="width:30px;height:30px" src="<?php echo e((file_exists(public_path('profile/'.Auth::user()->photo)))? url('profile/'.Auth::user()->photo) : 'https://user-media-prod-cdn.itsre-sumo.mozilla.net/uploads/products/2020-04-14-08-36-13-8dda6f.png'); ?>" alt="User Image">
      <div>
         <p class="app-sidebar__user-name"><?php echo e(Auth::user()->name); ?></p>
         <p class="app-sidebar__user-designation"><?php echo e(ucfirst(Auth::user()->level)); ?></p>
      </div>
   </div>

   <ul class="app-menu">
   <li class="text-muted" style="padding:12px 10px;font-size:small;background:#000"> <i class="fa fa-list" aria-hidden="true"></i> MENU</li>
           <li><a class="app-menu__item <?php echo e((Request::is(admin_path().'/dashboard'))?'active':''); ?>" href="<?php echo e(admin_url('dashboard')); ?>"><i class="app-menu__icon fa fa-tachometer"></i> <span class="app-menu__label">Dahsboard</span></a></li>
    <?php
    if(Auth::user()->level=='operator'){
      $menu = collect(get_module(true))->sortBy('position')->where('parent','=',false)->where('operator','==',true);
    }else {
      $menu = collect(get_module(true))->sortBy('position')->where('parent','=',false);
    }
    ?>

     <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if((Auth::user()->level=='operator' ? collect(get_module())->where('parent',$row['name'])->where('operator',true)->count() : collect(get_module(true))->where('parent',$row['name'])->count())> 0): ?>
     <li class="treeview <?php echo e(active_treeview($row['name'])); ?>" title="<?php echo e($row['description']); ?>" >
        <a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa <?php echo e($row['icon']); ?>"></i><span class="app-menu__label"><?php echo e($row['title']); ?></span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu" style="background:rgb(000,000,000,.4)">
          <?php $__currentLoopData = (Auth::user()->level=='operator' ? collect(get_module(true))->where('parent',$row['name'])->where('operator',true) : collect(get_module(true))->where('parent',$row['name'])); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><a class="treeview-item <?php echo e(active_item($row2['name'])); ?>" href="<?php echo e(admin_url($row2['name'])); ?>"><i class="icon fa fa-caret-right"></i> &nbsp; <?php echo e($row2['title']); ?></a></li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
     </li>

     <?php else: ?>

    <li title="<?php echo e(get_module_info('description')); ?>"><a class="app-menu__item <?php echo e(active_item($row['name'])); ?>" href="<?php echo e(admin_url($row['name'])); ?>"><i class="app-menu__icon fa <?php echo e($row['icon']); ?>"></i> <span class="app-menu__label"><?php echo e($row['title']); ?></span></a></li>

    <?php endif; ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <li class="text-muted" style="padding:12px 10px;font-size:small;background:#000"><i class="fa fa-lock" aria-hidden="true"></i> &nbsp; ADMINISTRATOR</li>

          <li title="Komentar Pengunjung"><a class="app-menu__item <?php echo e((Request::is(admin_path().'/comments'))? 'active':''); ?>" href="<?php echo e(admin_url('comments')); ?>"><i class="app-menu__icon fa fa-comments"></i> <span class="app-menu__label">Komentar</span></a></li>
    <?php if(Auth::user()->level=='admin'): ?>
    <?php $__currentLoopData = collect(get_master_module())->wherenotin('path',['dashboard','akun']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<li title="<?php echo e($r['title']); ?>"><a class="app-menu__item <?php echo e((Request::is(admin_path().'/'.$r['path']))?'active':''); ?>" href="<?php echo e(admin_url($r['path'])); ?>"><i class="app-menu__icon fa <?php echo e($r['icon']); ?>"></i> <span class="app-menu__label"><?php echo e($r['title']); ?></span></a></li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<li class="text-muted" style="padding:15px 10px;font-size:small;background:#000">Penyimpanan <?php echo e(disk_used()); ?> / 1000MB</li>

   </ul>
</aside>
<?php /**PATH C:\laragon\www\cmsv2\app\View/admin/layout/sidebar.blade.php ENDPATH**/ ?>