<?php $__env->startSection('main'); ?>

<?php echo $__env->make('Includes.Front.TopBanner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Includes.Front.PlayLists', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(count($hot_tracks)): ?>

<div class="container mt-2">
    <div class="sectionTitle">
        <h2 class="title">Hot Tracks</h2>
        
    </div>
    <div class="row  justify-content-between">
        <div class="col text-right">
        </div>
    </div>

    <div class="">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $hot_tracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide text-center mb-lg-5">
                    <div class="music-cart-wrapper scale-play-list p-3 p-sm-2 p-md-1 p-lg-3">
                        <a href="<?php echo e($post->url()); ?>">
                            <div class="music-cart">
                                <?php if(isset($post->poster)): ?>
                                <img src="<?php echo e($post->image('resize')); ?>" />
                                <?php else: ?>
                                <img src="<?php echo e(asset('frontend/images/newreleases.jpg')); ?>" />
                                <?php endif; ?>
                                <div class="img-cover"></div>
                            </div>
                            <div class="songInfo center">
                                <span class="artist" title="Baran"><?php echo e($post->singers()); ?></span>
                                <span class="song" title="Migzaroonam"><?php echo e(str_limit($post->title,20,' ...')); ?></span>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

</div>


<?php endif; ?>
<?php if(isset($categories)): ?>

<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="container mt-2">
    <div class="sectionTitle">
        <h2 class="title"><?php echo e($category->name); ?></h2>
        <a href="<?php echo e(route('Category.Show',$category->name)); ?>">See All</a>
    </div>
    <div class="row  justify-content-between">
        <div class="col text-right">
        </div>
    </div>
    <?php if(count($category->posts)): ?>
    <div class="">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $category->lastPosts(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide text-center mb-lg-5">
                    <div class="music-cart-wrapper scale-play-list p-3 p-sm-2 p-md-1 p-lg-3">
                        <a href="<?php echo e($post->url()); ?>">
                            <div class="music-cart">
                                <?php if(isset($post->poster)): ?>
                                <img src="<?php echo e($post->image('resize')); ?>" />
                                <?php else: ?>
                                <img src="<?php echo e(asset('frontend/images/newreleases.jpg')); ?>" />
                                <?php endif; ?>
                                <div class="img-cover"></div>
                            </div>
                            <div class="songInfo center">
                                <span class="artist" title="Baran"><?php echo e($post->singers()); ?></span>
                                <span class="song" title="Migzaroonam"><?php echo e(str_limit($post->title,20,' ...')); ?></span>
                            </div>
                        </a>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<?php if(isset($artists) && count($artists)): ?>
<div class="container mt-2">
    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Popular Artists</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-md-2">
            <div class="music-cart-wrapper Popular-Artists scale-play-list p-3 p-md-1 p-lg-3">
                <a href="<?php echo e($artist->url()); ?>">
                    <div class="music-cart">
                        <img src="<?php echo e(asset(unserialize($artist->photo)['resize'])); ?>" />
                        <div class="img-cover"></div>

                    </div>
                    <div class="songInfo text-center">
                        <span class="artist" title="<?php echo e($artist->name); ?>"><?php echo e($artist->name); ?></span>


                    </div>
                </a>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Front/index.blade.php ENDPATH**/ ?>