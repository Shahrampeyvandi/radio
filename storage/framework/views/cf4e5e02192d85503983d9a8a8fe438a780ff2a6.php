<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('main'); ?>


<div class="container">
    <div class="row">
        <div class="poster-wrapper ">
            <img class="artist-poster" src="<?php echo e(asset(unserialize($artist->photo)['banner'])); ?>" alt="">
            <div class="poster-overlay"></div>
        </div>

    </div>
</div>


<?php if(count($mp3s)): ?>
<div class="container mt-page ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">MP3s</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $mp3s; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__env->startComponent('components.music-box',['item' => $post]); ?>
        <?php echo $__env->renderComponent(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>
</div>
<?php endif; ?>


<?php if(isset($videos) && count($videos)): ?>
<div class="container mt-page ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Videos</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__env->startComponent('components.music-box',['item' => $post]); ?>
        <?php echo $__env->renderComponent(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Front/show-artist.blade.php ENDPATH**/ ?>