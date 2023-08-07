<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="authord" content="">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="">
    <meta property="twitter:creator" content="">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="">
    <meta property="og:title" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <meta property="og:description" content="">
    <title><?php echo e($title ? $title.' - Admin Panel '.get_option('site_title') : 'Admin Panel '.get_option('site_title')); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    <link rel="apple-touch-icon" sizes="180x180" href="https://forums.cpanel.net/data/avatars/s/922/922807.jpg">
    <meta name="theme-color" content="#009688"/>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo e(secure_asset('backend/css/main.css')); ?>">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="<?php echo e(secure_asset(get_option('favicon'))); ?>" type="image/x-icon" />
        <!-- Main Quill library -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style>
.pointer{
  cursor:pointer;
}
</style>
<?php if(\Session::has('success')): ?>
<script>
window.onload = function() {
  notif("<?php echo e(Session::get('success')); ?>","success");
};
</script>
<?php endif; ?>

<?php if(\Session::has('warning')): ?>
<script>
window.onload = function() {
  notif("<?php echo e(Session::get('warning')); ?>","warning");
};
</script>
<?php endif; ?>
<?php if(\Session::has('danger')): ?>
<script>
window.onload = function() {
  notif("<?php echo e(Session::get('danger')); ?>","danger");
};
</script>
<?php endif; ?>
<script src="<?php echo e(secure_asset('backend/js/jquery-3.3.1.min.js')); ?>"></script>

  </head>
  <body id="body" class="app sidebar-mini" >
  <?php echo $__env->make('admin.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('admin.layout.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


  <main class="app-content" style="background: #F0F0F1">
    <style>
    body {
      font-family:sans-serif;
    }
    .text-stroke {
      text-decoration:line-through;
    }
a:hover {
  text-decoration: none;
}
.btop {
  margin-top:-80px;right:0;position:absolute;
}
      input[type=text] {
        background-color:rgb(255,255,255,.8);
      }
      #editor {
        background-color:rgb(255,255,255,.8);

      }

      label.myLabel input[type="file"] {
          position: absolute;
          top: -1000px;
      }


      /***** Example custom styling *****/

      .myLabel {
          border: 1px solid #000;
          padding: 2px 5px;
          margin: 2px;
          background: #fff;
          font-size: 9px;
          cursor: pointer;
          display: inline-block;
      }

      .myLabel:hover {
          background: red;
      }

      .myLabel:active {
          background: #CCF;
      }

      .myLabel:invalid + span {
          color: #fff;
      }

      .myLabel:valid + span {
          color: #fff;
      }
      .card-list{
position: relative;
background: #ffffff;
border-radius: 3px;
padding: 10px;
-webkit-box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 1px 5px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);
margin-bottom: 10px;
-webkit-transition: all 0.3s ease-in-out;
-o-transition: all 0.3s ease-in-out;
transition: all 0.3s ease-in-out;
      }
    </style>

  <?php echo $__env->yieldContent('content'); ?>

  </main>
<script type="text/javascript">

$('.copy').click(function(){
var $temp = $("<input>");
$("body").append($temp);
$temp.val($(this).attr('data-copy')).select();
document.execCommand("copy");
notif('Copied','info');
$temp.remove();
});

function copy($val){
var $temp = $("<input>");
$("body").append($temp);
$temp.val($val).select();
document.execCommand("copy");
notif('Copied','info');
$temp.remove();
}

</script>
    <!-- Essential javascripts for application to work-->
     <script src="<?php echo e(secure_asset('backend/js/popper.min.js')); ?>"></script>
     <script src="<?php echo e(secure_asset('backend/js/bootstrap.min.js')); ?>"></script>
     <script src="<?php echo e(secure_asset('backend/js/main.js')); ?>"></script>
     <!-- The javascript plugin to display page loading on top-->
     <script src="<?php echo e(secure_asset('backend/js/plugins/pace.min.js')); ?>"></script>
     <!-- Page specific javascripts-->
     <script type="text/javascript" src="<?php echo e(secure_asset('backend/js/plugins/chart.js')); ?>"></script>
     <script type="text/javascript" src="<?php echo e(secure_asset('backend/js/plugins/select2.min.js')); ?>"></script>
     <script type="text/javascript" src="<?php echo e(secure_asset('backend/js/plugins/bootstrap-notify.min.js')); ?>"></script>
     <script type="text/javascript" src="<?php echo e(secure_asset('backend/js/plugins/sweetalert.min.js')); ?>"></script>
     <script type="text/javascript" src="<?php echo e(secure_asset('backend/js/plugins/jquery.dataTables.min.js')); ?>"></script>
     <script type="text/javascript" src="<?php echo e(secure_asset('backend/js/plugins/dataTables.bootstrap.min.js')); ?>"></script>
     <script type="text/javascript">$('#sampleTable').DataTable();</script>
     <script src="<?php echo e(secure_asset('backend/js/script.js')); ?>"></script>
   </body>
 </html>
<?php /**PATH /home/kulipixe/cmsv2/app/View/admin/layout/app.blade.php ENDPATH**/ ?>