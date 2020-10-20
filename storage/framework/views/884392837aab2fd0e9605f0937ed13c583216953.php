<div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="deletePostLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePostLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if(isset($title)): ?>
                <?php echo e($title); ?>

                <?php else: ?>
                برای حذف این مورد مطمئن هستید
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeletePost')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="post_id" id="post_id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteGallery" tabindex="-1" role="dialog" aria-labelledby="deleteGalleryLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteGalleryLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if(isset($title)): ?>
                <?php echo e($title); ?>

                <?php else: ?>
                برای حذف این مورد مطمئن هستید
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeleteGallery')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="gallery_id" id="gallery_id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deletePlaylist" tabindex="-1" role="dialog" aria-labelledby="deletePlaylistLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePlaylistLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if(isset($title)): ?>
                <?php echo e($title); ?>

                <?php else: ?>
                برای حذف این مورد مطمئن هستید
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeletePlayList')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="id" id="id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteArtist" tabindex="-1" role="dialog" aria-labelledby="deleteArtistLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteArtistLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if(isset($title)): ?>
                <?php echo e($title); ?>

                <?php else: ?>
                برای حذف این مورد مطمئن هستید
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <form action="<?php echo e(route('Panel.DeleteArtist')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="id" id="artist_id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php /**PATH C:\xampp1\htdocs\radio\resources\views/Includes/Panel/modals.blade.php ENDPATH**/ ?>