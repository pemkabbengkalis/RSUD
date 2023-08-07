<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta name="author" content="Abu Umar's House">
<meta charset="UTF-8">
<meta name="language" content="Indonesia" />
<meta name="revisit-after" content="7" />
<meta name="webcrawlers" content="all" />
<meta name="rating" content="general" />
<meta name="spiders" content="all" />
<meta name="robots" content="all" />
<meta property="fb:app_id" content="" />
<meta property="fb:pages" content="" />
<meta name="facebook-domain-verification" content="" />
<!-- meta fb og start -->
<meta property="og:url" content="<?php echo e($url); ?>" />
<meta property="og:type" content="article" />
<meta property="og:title" content="<?php echo e($title); ?>" />
<meta property="og:image" content="<?php echo e($thumbnail); ?>" />
<meta property="og:site_name" content="<?php echo e(get_option('site_title')); ?>" />
<meta property="og:description" content="<?php echo e($description); ?>" />
<meta name="description" content="<?php echo e($description); ?>">
<meta name="keywords" content="<?php echo e($keywords); ?>">
<!-- meta fb og end -->

  <!-- FAVICONS ICON -->
  <link rel="icon" href="<?php echo e(url(get_option('favicon'))); ?>" type="image/x-icon" />
  <!-- PAGE TITLE HERE -->
  <title><?php echo e(request()->is('/') ? $title : $title.' - '.get_option('site_title')); ?></title>

  <!-- MOBILE SPECIFIC -->
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, shrink-to-fit=no">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="theme-color" content="#07c">
  <!-- home screen icon defaults - 48x48 -->
  <link rel="apple-touch-icon" href=""/>
  <meta name="HandheldFriendly" content="True">
  <link rel="apple-touch-startup-image" href="">
  <meta name="application-name" content="<?php echo e(get_option('site_title')); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <?php if(!request()->is('/')): ?>
  <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=63e08254b71a0b00126c118c&product=inline-share-buttons" async="async"></script>
  <?php endif; ?><?php /**PATH /home/kulipixe/cmsv2/resources/views/init/header.blade.php ENDPATH**/ ?>