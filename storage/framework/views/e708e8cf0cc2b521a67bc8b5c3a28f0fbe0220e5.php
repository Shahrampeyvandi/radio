<div class="container mt-page ">
    <div class="row mt-2 justify-content-center">
       <?php $__currentLoopData = $banners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-12 col-md-6 ">
            <div class="music-cart-wrapper p-2">
            <a href="<?php echo e($item->url()); ?>">
                    <div class="music-cart">
                        <img src="<?php echo e($item->image('banner')); ?>" />
                        <div class="img-cover"></div>
                        <span class="tag">mp3</span>
                    </div>
                    <div class="songInfo center">
                        <span class="artist" title="<?php echo e($item->singers()); ?>"><?php echo e($item->singers()); ?></span>
                        <span class="song" title="<?php echo e($item->title); ?>"><?php echo e($item->title); ?></span>

                    </div>
                </a>
            </div>
        </div>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
    </div>
</div><?php /**PATH C:\xampp\htdocs\radio\resources\views/Includes/Front/TopBanner.blade.php ENDPATH**/ ?>