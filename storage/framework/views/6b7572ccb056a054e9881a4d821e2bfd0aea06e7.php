<?php if($songs): ?>

    <div class="music-cart-wrapper scale-play-list p-3 p-sm-2 p-md-1 p-lg-2">
        <a href="<?php echo e($playlist->playurl()); ?>">
            <div class="music-cart">
                <?php if(isset($playlist->image) && !is_null($playlist->image)): ?>
                <img src="<?php echo e(asset($playlist->image)); ?>" />
                <?php else: ?>
                <img src="<?php echo e(asset('frontend/images/remix.jpg')); ?>" />
                <?php endif; ?>

                <div class="img-cover"></div>
            </div>
            <div class="songInfo center">
                <span class="artist" title="<?php echo e($playlist->name); ?>"><?php echo e($playlist->name); ?></span>

            </div>
        </a>
    </div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/components/playlist-item.blade.php ENDPATH**/ ?>