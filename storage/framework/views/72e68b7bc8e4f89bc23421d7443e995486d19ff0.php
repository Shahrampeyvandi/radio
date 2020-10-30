<?php $__env->startSection('content'); ?>

<div class="modal fade" id="deleteAlbum" tabindex="-1" role="dialog" aria-labelledby="deleteAlbumLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAlbumLabel">اخطار</h5>
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
                <form action="<?php echo e(route('Panel.DeleteAlbum')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="id" id="album_id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('Includes.Panel.albummenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center"> Albums</h5>
            <hr>
        </div>
        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th></th>
                    <th> Name </th>
                    <th> Singer(s) </th>
                    <th>Songs</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td>
                        <a href="#" class="text-primary"><?php echo e($album->name); ?></a>
                    </td>
                    <td>
                        <?php $__currentLoopData = $album->singers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($singer->url()); ?>" class="text-primary"><?php echo e($singer->fullname); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php echo e(count($album->posts)); ?>

                    </td>

                    <td>
                        <?php echo e(\Carbon\Carbon::parse($album->created_at)->format('d F Y')); ?>

                    </td>
                    <td>
                        <a href="<?php echo e(route('Panel.EditAlbum',$album)); ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="#" data-id="<?php echo e($album->id); ?>" title="حذف " data-toggle="modal" data-target="#deleteAlbum"
                            class="btn btn-sm btn-danger   m-2">

                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $('#deleteAlbum').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#album_id').val(recipient)

    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\radio\resources\views/Panel/Album/List.blade.php ENDPATH**/ ?>