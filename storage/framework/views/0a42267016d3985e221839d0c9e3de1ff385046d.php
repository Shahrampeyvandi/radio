<?php if(isset($playlists) && count($playlists)): ?>
<div class="container mt-2">
    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Playlists</h2>
            </div>
        </div>
       <?php if($playlist_more): ?>
            <div class="col text-right">
            <a class="viewMore button primaryButton" href="<?php echo e(route('Playlists')); ?>">View More</a>
        </div>
       <?php endif; ?>
    </div>
    <div class="">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $playlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide text-center mb-lg-5">
                    <?php $__env->startComponent('components.playlist-item',['playlist'=>$playlist,'songs'=>count($playlist->tracks)]); ?>
                    <?php echo $__env->renderComponent(); ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!-- Add Scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH C:\xampp1\htdocs\radio\resources\views/Includes/Front/PlayLists.blade.php ENDPATH**/ ?>