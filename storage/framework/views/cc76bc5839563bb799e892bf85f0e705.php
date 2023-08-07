<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(url('backend/css/main.css')); ?>">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Masuk - <?php echo e(get_option('site_title')); ?></title>
    <link rel="shortcut icon" href="<?php echo e(url(get_option('favicon'))); ?>" />
    <meta property="og:title" content="Masuk - <?php echo e(get_option('site_title')); ?>" />
<meta property="og:image" content="<?php echo e(url(get_option('logo'))); ?>" />
<meta property="og:site_name" content="<?php echo e(get_option('site_title')); ?>" />
<meta property="og:description" content="Masuk Sebagai Admin / Operator" />
<?php echo ReCaptcha::htmlScriptTagJsApi(); ?>

  </head>
  <body>

    <section class="login-content" style="background:#000">
      <div class="login-box" style=background:transparent;box-shadow:none;width:100%">

        <form method="POST"  style="width:300px;margin-left:auto;margin-right:auto"  action="<?php echo e(route('login')); ?>">
          <center>
            <img height="80" src="<?php echo e(secure_asset(get_option('favicon'))); ?>">
            <br>
            <br>
            <h4 class="text-warning"><?php echo e(get_option('site_title')); ?></h4>
            <br>
            
            <?php if(get_option('site_maintenance')=='Y'): ?>
          <center> <p class="badge badge-danger">Modus Perbaikan Aktif</p></center>
                 
            <?php endif; ?>
          </center>
            <?php echo csrf_field(); ?>
                <?php if(session()->has('error')): ?>
                <div class="alert alert-dismissible alert-danger">
                  <button class="close" type="button" data-dismiss="alert">×</button> <?php echo e(session('error')); ?></div>
                <?php endif; ?>
                
          <div class="form-group">
            <label class="control-label" style="color:#f5f5f5">Nama Pengguna</label>
                <input id="username" placeholder="Username" type="text" class="form-control form-control-lg <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="username" required autocomplete="username" autofocus>
          </div>
          <div class="form-group">
            <label class="control-label" style="color:#f5f5f5">Kata Sandi</label>
                <input id="password" placeholder="*****" type="password" class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password" autofocus>
          </div>
          <div class="form-group w-100">
	<div style="width:%"> <?php echo htmlFormSnippet(); ?> </div>
</div>
        
          <div class="form-group btn-container">
            <button class="btn btn-warning btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>MASUK</button>
          </div>
        
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="<?php echo e(url('backend/js/jquery-3.3.1.min.js')); ?>"></script>
    <script src="<?php echo e(url('backend/js/popper.min.js')); ?>"></script>
    <script src="<?php echo e(url('backend/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(url('backend/js/main.js')); ?>"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?php echo e(url('backend/js/plugins/pace.min.js')); ?>"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>
<?php /**PATH C:\laragon\www\cmsv2\app\View/auth/login.blade.php ENDPATH**/ ?>