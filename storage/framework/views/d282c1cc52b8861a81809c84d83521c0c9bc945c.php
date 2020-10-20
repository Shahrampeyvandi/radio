<?php $__env->startSection('main'); ?>
<?php echo $__env->make('Includes.Front.TopSlider',['sliders'=>$sliders,'type'=>'video'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Includes.Front.Alfabet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(count($trending)): ?>
<div class="container mt-page ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Trending</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $trending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__env->startComponent('components.video-box',['video'=>$item]); ?>
        <?php echo $__env->renderComponent(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


    </div>
</div>
<?php endif; ?>
<div class="container">
    <div class="row">
        <div class="col-12 ">
            <dl class="tabs" data-tab="">
                <dd class="tab tab-c-con active"><a class="tab-c" href="#panel2-1">Featured</a></dd>
                <dd class="tab tab-c-con"><a class="tab-c" href="#panel2-2">Popular This Month</a></dd>
                <dd class="tab tab-c-con"><a class="tab-c" href="#panel2-3">Popular This Week</a></dd>
                <dd class="tab tab-c-con"><a class="tab-c" href="#panel2-4">Popular All Time</a></dd>
            </dl>
            <div class="row panel2" id="panel2-1">

                <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startComponent('components.video-box',['video'=>$item]); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(count($featured) > 23): ?>
                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="#">
                        <span class="view-event-sp music-cart-wrapper">View Event</span>
                    </a>
                </div>
                <?php endif; ?>

            </div>
            <div class="row panel2" id="panel2-2" style="display: none">

                <?php $__currentLoopData = $this_month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startComponent('components.video-box',['video'=>$item]); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($this_month) > 23): ?>

                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="<?php echo e(route('S.ShowMore')); ?>?type=video&q=this_month">
                        <span class="view-event-sp music-cart-wrapper">View Event</span>
                    </a>
                </div>
                <?php endif; ?>

            </div>

            <div class="row panel2" id="panel2-3" style="display: none">
                <?php $__currentLoopData = $this_week; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startComponent('components.video-box',['video'=>$item]); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(count($this_week) > 23): ?>

                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="<?php echo e(route('S.ShowMore')); ?>?type=video&q=this_week">
                        <span class="view-event-sp music-cart-wrapper">View Event</span>
                    </a>
                </div>
                <?php endif; ?>

            </div>

            <div class="row panel2" id="panel2-4" style="display: none">
                <?php $__currentLoopData = $all_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startComponent('components.video-box',['video'=>$item]); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(count($all_time) > 23): ?>
                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="<?php echo e(route('S.ShowMore')); ?>?type=video&q=all_time">
                        <span class="view-event-sp music-cart-wrapper">View Event</span>
                    </a>
                </div>
                <?php endif; ?>

            </div>


        </div>

    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Front/videos.blade.php ENDPATH**/ ?>