<!doctype html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/swiper.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/index.css')); ?>">
    <script src="<?php echo e(asset('frontend/assets/js/jquery-3.5.1.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/js/swiper.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/js/all.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/js/index.js')); ?>"></script>
    <meta charset="UTF-8">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>   sione |  <?php echo $__env->yieldContent('Title'); ?></title>
</head>

<body>
<div class="lds-ripple center-screen" style="display: none"><div></div><div></div></div>
    <?php echo $__env->yieldContent('content'); ?>

</body>

</html><?php /**PATH C:\xampp\htdocs\tm\resources\views/Layout/Front.blade.php ENDPATH**/ ?>