<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('main'); ?>

<div class="mt-page">
    <div id="breadcrumbs_container" class="container">
        <div class="row">
            <div class="col">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo e(route('MainUrl')); ?>"><i class="fa fa-home"></i></a></li>
                    <li><a href="#">
                            Photos
                        </a></li>
                    <li><a href="#">
                            <?php echo e($gallery->title); ?>

                        </a></li>
                    <li class="current"><a href="#"><?php echo e(\Carbon\Carbon::parse($gallery->created_at)->format('F')); ?></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container ">
    <div class="min-h-15">
        <div class="row photos-wrapper image-set">
            <?php $__currentLoopData = $gallery->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-4 col-md-1 photo-cart music-cart-wrapper scale-play-list ">
            <a href="<?php echo e(asset(unserialize($item->url)['org'])); ?>" data-lightbox="roadtrip">
                    <img
                        class="photo-cart-img" src="<?php echo e(asset(unserialize($item->url)['resize'])); ?>"></a></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('frontend/assets/js/lightbox.js')); ?>"></script>
<script>
    $('.image-set a').lightBox()
</script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/lightbox/lightbox.css')); ?>">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Front/show-gallery.blade.php ENDPATH**/ ?>