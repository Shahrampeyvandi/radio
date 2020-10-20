<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('main'); ?>
<?php echo $__env->make('Includes.Front.TopSlider',['sliders' => $sliders,'type'=>'photo'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(count($gallery->images)): ?>
    
<div class="container border-photo-top  justify-content-center text-center">
    <span class="photo-top-tt"><?php echo e(\Carbon\Carbon::parse($gallery->created_at)->format('F')); ?><br>
        <?php echo e(\Carbon\Carbon::parse($gallery->created_at)->year); ?>

    </span>
    <div class="row">
        <div class="col text-left">
            <h4 class="text-light"><?php echo e($gallery->title); ?></h4>
        </div>
    </div>
    <div class="row">

        <?php $__currentLoopData = $gallery->images->take(8)->chunk(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$chunked): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-12 col-md-6 mb-5">
            <div class="row">
                <?php $__currentLoopData = $chunked; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key2=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($key == 1 && $key2 === array_key_last($chunked->toArray())): ?>
            <div class="col-3 photo-cart music-cart-wrapper scale-play-list view-event"><a href="<?php echo e($gallery->url()); ?>"><span
                            class="view-event-sp">View Event</span></a></div>
                <?php else: ?>
                <div class="col-3 photo-cart music-cart-wrapper scale-play-list "><a href="#"><img
                            class="photo-cart-img" src="<?php echo e(asset(unserialize($item->url)['resize'])); ?>"></a></div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Front/photos.blade.php ENDPATH**/ ?>