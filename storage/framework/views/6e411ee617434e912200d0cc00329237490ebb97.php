<?php if(isset($sliders) && count($sliders) > 5): ?>
<div class="<?php echo e($type == 'photo' ? 'position-relative mb-5' : 'container'); ?>  mt-page">

    <div id="touchSlider5" class="<?php echo e($type == 'photo' ? '' : 'music-page-slider'); ?> ">
        <ul>
            <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <img src="<?php echo e($slider->image('banner')); ?>" style="width: 100%;" />
                <div class="songInfo inline">
                    <?php if($type == 'photo'): ?>
                <span class="title" title="<?php echo e($slider->title); ?>"><?php echo e($slider->title); ?></span>
                    <span class="date"><?php echo e($slider->created_at); ?></span>
                    <?php else: ?>
                    <span class="date"><?php echo e($slider->singers()); ?> - </span>
                    <span class="title" title="<?php echo e($slider->title); ?>"><?php echo e($slider->title); ?></span>
                    <?php endif; ?>
                </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Includes/Front/TopSlider.blade.php ENDPATH**/ ?>