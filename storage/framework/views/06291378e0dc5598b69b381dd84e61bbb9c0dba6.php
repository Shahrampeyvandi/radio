<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('main'); ?>
<?php echo $__env->make('Includes.Front.BreadCrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-9 pb-3 justify-content-center text-center">
            <?php if(count($post->files)): ?>
            <video id="my-video" class="video-js vjs-default-skin" controls data-setup='{}'>
                <?php $__currentLoopData = $post->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <source src="https://dl.radioavin.com/<?php echo e($file->url); ?>" type='video/mp4' label='<?php echo e($file->quality_id); ?>'
                    res='<?php echo e($file->quality_id); ?>' />
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </video>
            <div class="playpause">play</div>
            <?php endif; ?>
        </div>
        <div class="col-12 col-md-3 music-cart-h-wrapper pl-md-0">
            <dl class="tabs" data-tab="">
                <dd class="active tab tab-b-con"><a class="tab-b" href="#related_posts">related</a></dd>
                <dd class="tab tab-b-con"><a class="tab-b" href="#this_week">lyrics</a></dd>
            </dl>
            <div class="panel1 play-list" id="related_posts">
                <?php $__currentLoopData = $related_posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php $__env->startComponent('components.list-view',['item'=>$item]); ?>
                   
               <?php echo $__env->renderComponent(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="panel1" id="this_week" style="display: none">
                <span class="lyrics-span">
                    <?php echo $post->description; ?>

                </span>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('frontend/assets/js/videojs.js')); ?>"></script>
<script>
    var options = {};
    videojs('my-video').videoJsResolutionSwitcher()
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link href="<?php echo e(asset('frontend/assets/css/videojs.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Front/show-video.blade.php ENDPATH**/ ?>