<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
         <!--begin::Fonts-->
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
         <link href="<?php echo e(asset('offices/css/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
		 <link href="<?php echo e(asset('offices/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
		 <link href="<?php echo e(asset('offices/css/custom.css')); ?>" rel="stylesheet" type="text/css" />
         <title><?php echo e($title); ?></title>
    </head>
</head>
<body>
    <?php echo e($slot); ?>

    
    <script src="<?php echo e(asset('offices/js/scripts.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('offices/js/plugins.bundle.js')); ?>"></script>
    <script src="<?php echo e(asset('offices/js/auth.js')); ?>"></script>
    
    <?php echo $__env->yieldContent('custom_js'); ?>
</body>
</html><?php /**PATH C:\laragon\www\perpustakaan-l8-h\resources\views/theme/office/auth/index.blade.php ENDPATH**/ ?>