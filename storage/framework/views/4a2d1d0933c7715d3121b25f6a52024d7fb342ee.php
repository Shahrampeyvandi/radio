<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('main'); ?>
<div class="showall-container">
    <?php if(count($posts)): ?>
<div class="container ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title mb-2"><?php echo e($page_title); ?></h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        
             <?php $__env->startComponent('components.music-box',['item' => $item]); ?>
                <?php echo $__env->renderComponent(); ?>
        
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>
</div>
<?php endif; ?>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Front/show-all.blade.php ENDPATH**/ ?>