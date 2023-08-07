<!-- Navbar-->
<header class="app-header" style="background:#222d32"><a href="" class="app-header__logo" style="color:#fff;background:transparent">Admin<b>Panel</b></a>
  <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
  <!-- Navbar Right Menu-->
  <ul class="app-nav" >
    <!--Notification Menu-->
        <li class="item" title="Kunjungi Website"><a class="app-nav__item" href="<?php echo e(url('/')); ?>" target="_blank"><i class="fa fa-globe fa-lg"></i></a></li>
  

    <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
      <ul class="dropdown-menu settings-menu dropdown-menu-right">
        <li><a class="dropdown-item" href="<?php echo e(admin_url('pengaturan')); ?>"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
        <li><a class="dropdown-item" href="<?php echo e(admin_url('akun')); ?>"><i class="fa fa-user fa-lg"></i> Profile</a></li>
        <li>  <form action="<?php echo e(route('logout')); ?>" method="POST">
                      <?php echo csrf_field(); ?>
                      <button class="dropdown-item" type="submit"><i class="fa fa-sign-out fa-lg"></i> Logout</button>
                    </form></li>
      </ul>
    </li>
  </ul>
</header>
<?php /**PATH /home/kulipixe/cmsv2/app/View/admin/layout/header.blade.php ENDPATH**/ ?>