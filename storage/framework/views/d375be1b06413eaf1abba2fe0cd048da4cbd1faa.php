<?php $__env->startSection('main'); ?>
<section class="mt-10 mh-80">

    <?php echo $__env->make('Includes.Front.Alfabet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <a href="<?php echo e(url()->previous()); ?>" style="    color: #ffffff7a;
">
                        <i class="fa fa-angle-left fa-2x"> </i>
                    </a>
                    <span style="color: white;font-size: 20px">
                        <?php echo e($q); ?>

                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $singers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-md-2 filter-item">
                <a href="<?php echo e($item->url()); ?>">
                    <img src="<?php echo e($item->image('resize')); ?>" alt="<?php echo e($item->fullname); ?>">
                    <div class="songInfo">
                        <span class="artist" title="<?php echo e($item->fullname); ?>"><?php echo e($item->fullname); ?></span>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Front/show-filter.blade.php ENDPATH**/ ?>