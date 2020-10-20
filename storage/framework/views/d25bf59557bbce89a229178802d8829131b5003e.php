<?php $__env->startSection('main'); ?>
<?php echo $__env->make('Includes.Front.TopSlider',['sliders' => $sliders,'type'=>'music'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Includes.Front.Alfabet', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container">
    <div class="row mb-2">
        <div class="col-12 col-md-9">
            <dl class="tabs" data-tab="">
                <dd class="tab tab-c-con active"><a class="tab-c" href="#panel2-1">Trending Now</a></dd>
                <dd class="tab tab-c-con"><a class="tab-c" href="#panel2-2">Featured Songs</a></dd>
            </dl>
            <div class="row panel2" id="panel2-1">
                <?php if(count($trending)): ?>
                <?php $__currentLoopData = $trending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startComponent('components.music-box',['item' => $item]); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($trending) > 23): ?>
                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="<?php echo e(route('S.ShowMore')); ?>?type=music&q=trending">
                        <span class="view-event-sp music-cart-wrapper">View More</span>
                    </a>
                </div>
                <?php endif; ?>
                <?php endif; ?>

            </div>

            <div class="row panel2" id="panel2-2" style="display: none">
                <?php if(count($featured)): ?>
                <?php $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startComponent('components.music-box',['item' => $item]); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php if(count($featured) > 23): ?>
                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="<?php echo e(route('S.ShowMore')); ?>?type=music&q=featured">
                        <span class="view-event-sp music-cart-wrapper">View More</span>
                    </a>
                </div>
                <?php endif; ?>
                <?php endif; ?>

            </div>


        </div>
        <div class="col-12 col-md-3 music-cart-h-wrapper pl-md-0">
            <dl class="tabs" data-tab="">
                <dd class="active tab tab-b-con"><a class="tab-b" href="#this_month">This Month</a></dd>
                <dd class="tab tab-b-con"><a class="tab-b" href="#this_week">This Week</a></dd>
                <dd class="tab tab-b-con"><a class="tab-b" href="#all_time">All time</a></dd>
            </dl>
            <div class="panel1" id="this_month">
                <?php if(count($this_month)): ?>
                <?php $__currentLoopData = $this_month; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startComponent('components.list-view',['item'=>$item]); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="music-cart-h view-event ">
                    <a class="text-center" href="<?php echo e(route('S.ShowMore')); ?>?type=music&q=this_month">
                        <span class="view-event-sp music-cart-wrapper">View More</span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="panel1" id="this_week" style="display: none">
                <?php if(count($this_month)): ?>
                <?php $__currentLoopData = $this_week; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startComponent('components.list-view',['item'=>$item]); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <div class="music-cart-h view-event ">
                    <a class="text-center" href="<?php echo e(route('S.ShowMore')); ?>?type=music&q=this_week">
                        <span class="view-event-sp music-cart-wrapper">View More</span>
                    </a>
                </div>
            </div>
            <div class="panel1" id="all_time" style="display: none">
                <?php if(count($this_month)): ?>
                <?php $__currentLoopData = $all_time; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__env->startComponent('components.list-view',['item'=>$item]); ?>
                <?php echo $__env->renderComponent(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                <div class="music-cart-h view-event ">
                    <a class="text-center" href="<?php echo e(route('S.ShowMore')); ?>?type=music&q=all_time">
                        <span class="view-event-sp music-cart-wrapper">View More</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(count($albums)): ?>
<div class="container mt-5 mb-5">
    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">New Albums</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $__env->startComponent('components.album-box',['album'=>$album]); ?>
        <?php echo $__env->renderComponent(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Front/mp3s.blade.php ENDPATH**/ ?>