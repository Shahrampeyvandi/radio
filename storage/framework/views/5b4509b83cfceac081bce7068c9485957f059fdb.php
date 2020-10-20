<?php $__env->startSection('content'); ?>

<div class="container-fluid">
   <?php if(!isset($post)): ?>
        <?php echo $__env->make('Includes.Panel.moviesmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   <?php endif; ?>
    <div class="card">
        <div class="card-body">

            <form id="upload-music" method="post" <?php if(isset($post)): ?> action="<?php echo e(route('Panel.EditVideo',$post)); ?>" <?php else: ?>
                action="<?php echo e(route('Panel.AddVideo')); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card-title d-flex justify-content-between">
                    <h5 class="text-center">
                        <?php if(isset($post)): ?>
                        Edit Video
                        <?php else: ?>
                        Add Video
                        <?php endif; ?>


                    </h5>

                    <button type="submit" class="btn btn-primary">
                        <?php if(isset($post)): ?>
                        ویرایش
                        <?php else: ?>
                        ذخیره
                        <?php endif; ?>
                    </button>

                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                       <?php echo $__env->make('Includes.Panel.VideoForm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                     <?php echo $__env->make('Includes.Panel.Video', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        
                    </div>
                    <?php echo $__env->make('Includes.Panel.VideoSideForm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            
              
                    <div class="col-md-12 my-2 btn--wrapper text-center">
                        <input type="submit" name="upload" id="upload" value="Upload" class="btn  btn-success" />
                    </div>
               
                <hr>
                <div class="progress col-md-12 p-0">
                    <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                        style="width: 0%">
                        0%
                    </div>
                </div>
            </form>
            <hr>
        </div>
    </div>

    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.min.css')); ?>">
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.min.js')); ?>"></script>
   
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\radio\resources\views/Panel/Video/add.blade.php ENDPATH**/ ?>