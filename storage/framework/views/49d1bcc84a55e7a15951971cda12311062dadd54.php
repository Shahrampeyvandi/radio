<?php $__env->startSection('title',$title); ?>

<?php $__env->startSection('main'); ?>
<div class="playlist-container">
    <?php if(count($featured)): ?>
<div class="container mt-page ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Featured Playlists</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-md-2">
            <?php $__env->startComponent('components.playlist-item',['playlist'=>$item,'songs'=>count($item->tracks)]); ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>
</div>
<?php endif; ?>
<?php if(count($browse)): ?>
<div class="container">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Browse</h2>
            </div>
        </div>
        <div class="col text-right">

        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $browse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-md-2">
            <?php $__env->startComponent('components.playlist-item',['playlist'=>$item,'songs'=>count($item->tracks)]); ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>

<?php if(isset($my_playlists) && count($my_playlists)): ?>
<div class="container">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">My PlayLists</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
       <?php $__currentLoopData = $my_playlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-2">
            <?php $__env->startComponent('components.playlist-item',['playlist'=>$item,'songs'=>count($item->tracks)]); ?>
            <?php echo $__env->renderComponent(); ?>
        </div>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\radio\resources\views/Front/playlists.blade.php ENDPATH**/ ?>