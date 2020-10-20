<div class="col-6 col-md-2">
    <div class="music-cart-wrapper scale-play-list p-3 p-sm-2 p-md-1 p-lg-2">
    <a href="<?php echo e($album->playurl()); ?>">
            <div class="music-cart">
                <img src="<?php echo e(asset($album->image)); ?>" />
                <div class="img-cover"></div>
            </div>
            <div class="songInfo center">
                <span class="artist" title="<?php echo e($album->name); ?>"><?php echo e($album->name); ?></span>
                
            </div>
        </a>
    </div>
</div><?php /**PATH C:\xampp\htdocs\radio\resources\views/components/album-box.blade.php ENDPATH**/ ?>