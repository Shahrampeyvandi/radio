<?php $__env->startSection('main'); ?>
<div class="container mt-page ">
    <div class="row text-center justify-content-center">
        <div id="playlist" class="col-md-12">
            <div class="panelsContainer">
                <div class="mainPanel">
                    <div class="panelInner">
                        <h2 class="title text-white"><?php echo e($playlist->name); ?></h2>
                        <div id="actions" class="playlist_container actions flexContainer center">
                            <a class="button textButton light" href="#" id="rename_link" data-id="1"
                                onclick="editPlaylistName(event,'<?php echo e($playlist->id); ?>')">
                                <i class="fas fa-pen"></i>
                                Rename
                            </a>
                            <a id="delete_link" class="button textButton light" href="#"
                                onclick="deletePlaylist(event,'<?php echo e($playlist->id); ?>','<?php echo e($playlist->name); ?>')">
                                <i class="fa fa-trash"></i>
                                Delete
                            </a>
                            <a href="<?php echo e($playlist->playurl()); ?>" class="play_all button textButton light">

                                <i class="fa fa-play"></i>
                                Play
                            </a>
                            <a href="/mp3s/playlist_start?id=efbe47c297b9&amp;shuffle=1"
                                class="shuffle_all button textButton light">
                                <i class="fas fa-random"></i>
                                Shuffle
                            </a>
                        </div>
                        <div class="list-tracks">
                            <ul class="listView">
                                <?php $__currentLoopData = $playlist->tracks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$track): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <span class="track ui-sortable-handle"><?php echo e(($key++)); ?>.</span>
                                    <span style="margin-right:auto;" class="ui-sortable-handle">
                                        <a href="">
                                            <img border="0" alt="" src="<?php echo e($track->image('resize')); ?>">
                                            <div class="songInfo">
                                                <span class="artist ui-sortable-handle"
                                                    title="<?php echo e($track->title); ?>"><?php echo e($track->title); ?></span>
                                                <span class="song ui-sortable-handle"
                                                    title="<?php echo e($track->singers()); ?>"><?php echo e($track->singers()); ?></span>
                                            </div>
                                        </a>
                                    </span>
                                    <span class="ui-sortable-handle">
                                        <form action="<?php echo e(route('UserPlaylist.Delete')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                        <input type="hidden" name="playlist_id" value="<?php echo e($playlist->id); ?>" >
                                        <input type="hidden" name="id" value="<?php echo e($track->id); ?>" >
                                            <button class="delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </span>
                                </li>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          

          
           
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\radio\resources\views/Front/edit-playlist.blade.php ENDPATH**/ ?>