<div class="music-cart-h ">
    <a href="<?php echo e($item->url()); ?>">
        <div class="music-cart">
            <img src="<?php echo e($item->image('resize')); ?>" />

            <div class="img-cover"></div>

        </div>
        <div class="songInfo center">
            <span class="artist" title="<?php echo e($item->singers()); ?>"><?php echo e($item->singers()); ?></span>
            <span class="song" title="<?php echo e($item->title); ?>"><?php echo e($item->title); ?></span>

        </div>
    </a>
    <a href="#" onclick="call(event)" id="<?php echo e($item->id); ?>" data-id="<?php echo e($item->id); ?>" data-type="music" class="add-favorite plus">
        +
    </a>
</div><?php /**PATH C:\xampp1\htdocs\radio\resources\views/components/list-view.blade.php ENDPATH**/ ?>