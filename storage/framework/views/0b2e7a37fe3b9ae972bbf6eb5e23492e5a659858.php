<div class="col-6 col-md-2">
    <div class="music-cart-wrapper scale-play-list p-3 p-sm-2 p-md-1 p-lg-1">
        <a href="<?php echo e($item->url()); ?>">
            <div class="music-cart">
                <img src="<?php echo e($item->image('resize')); ?>" class="size-131" />
                <div class="img-cover"></div>

            </div>
            <div class="songInfo center">
                <span class="artist" title="<?php echo e($item->singers()); ?>"><?php echo e($item->singers()); ?></span>
                <span class="song" title="<?php echo e($item->title); ?>"><?php echo e($item->title); ?></span>

            </div>
        </a>
    </div>
<a href="#" onclick="call(event)" data-id="<?php echo e($item->id); ?>" data-type="music" class='add-to-pl plus-button' id="<?php echo e($item->id); ?>"> + </a>
</div><?php /**PATH C:\xampp1\htdocs\radio\resources\views/components/music-box.blade.php ENDPATH**/ ?>