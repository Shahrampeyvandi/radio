<?php $__env->startSection('content'); ?>

<?php echo $__env->make('Includes.Panel.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('Includes.Panel.playlistmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">Play List </h5>
            <hr>
        </div>
        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    
                    <th></th>
                    <th> Name </th>
                    <th>Songs</th>
                    <th>Created At</th>
                    <th>Poster</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $playlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$playlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key+1); ?></td>
                    <td>
                        <a href="#" class="text-primary"><?php echo e($playlist->name); ?></a>
                    </td>
                    <td>
                        <?php echo e(count($playlist->tracks)); ?>

                    </td>
                    <td>
                        <?php echo e(\Carbon\Carbon::parse($playlist->created_at)->format('d F Y')); ?>

                    </td>
                    <td>
                        <img src="<?php echo e(asset($playlist->image)); ?>" alt="" width="100px">
                    </td>
                    <td class="text-center"> 
                        <a href="<?php echo e(route('Panel.EditPlayList',$playlist)); ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="#" data-id="<?php echo e($playlist->id); ?>" title="حذف " data-toggle="modal" data-target="#deletePlaylist"
                            class="btn btn-sm btn-danger   m-2">
                            <i class="fa fa-trash"></i>
                        </a>
                         <a href="#"  title=" "
                         onclick="changeFeaturedPlaylist(event,'<?php echo e($playlist->id); ?>','<?php echo e(route('Panel.ChangeFeatured')); ?>')"
                            class="btn btn-sm <?php echo e($playlist->featured == 1 ? 'btn-success ' : 'btn-danger '); ?>   m-2">
                           Featured
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
  $('#deletePlaylist').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#id').val(recipient)

    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Panel/PlayList/List.blade.php ENDPATH**/ ?>