<?php $__env->startSection('content'); ?>

<?php echo $__env->make('Includes.Panel.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 <?php echo $__env->make('Includes.Panel.artistmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">Artist List</h5>
            <hr>
        </div>
        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                   >
                    <th></th>
                    <th> Name </th>
                    <th>BirthDay</th>
                    <th>Rate</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php $__currentLoopData = $artists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$artist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                   
                    <td><?php echo e($key+1); ?></td>
                    <td>
                        <a href="#" class="text-primary"><?php echo e($artist->fullname); ?></a>
                    </td>
               

                    <td>
                    
                       <?php echo e(\Carbon\Carbon::parse($artist->birthday)->format('d F Y')); ?>

                    </td>
                    <td>
                        6.1 از 10
                    </td>
                    <td>
                        <a href="<?php echo e(route('Panel.EditArtist',$artist)); ?>" class="btn btn-sm btn-info">Edit</a>
                        <a href="#" data-id="<?php echo e($artist->id); ?>" title="حذف " data-toggle="modal" data-target="#deleteArtist"
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
  $('#deleteArtist').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#artist_id').val(recipient)

    })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Panel/Artist/List.blade.php ENDPATH**/ ?>