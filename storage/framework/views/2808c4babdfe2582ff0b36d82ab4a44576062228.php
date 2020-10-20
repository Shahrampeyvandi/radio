<?php if(isset($post)): ?>
<div class="mt-page">
    <div id="breadcrumbs_container" class="container">
        <div class="row">
            <div class="col">
                <ul class="breadcrumbs">
                    <li><a href="<?php echo e(route('MainUrl')); ?>"><i class="fa fa-home"></i></a></li>
                    <li><a href="#">
                            <?php if($post->type == 'music'): ?>
                            MP3s
                            <?php elseif($post->type == 'podcast'): ?>
                            PodCasts
                            <?php else: ?>
                            Videos
                            <?php endif; ?>
                        </a></li>
                    <?php if(isset($playlist)): ?>
                    <li><a href="#"><?php echo e($playlist->name); ?></a></li>
                    <?php endif; ?>
                    <?php if(isset($album)): ?>
                    <li><a href="#"><?php echo e($album->name); ?></a></li>
                    <?php endif; ?>
                    <li class="current"><a href="#"><?php echo e($post->title); ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Includes/Front/BreadCrumb.blade.php ENDPATH**/ ?>