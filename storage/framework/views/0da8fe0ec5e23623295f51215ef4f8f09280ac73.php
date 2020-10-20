<?php $__env->startSection('content'); ?>
<?php if(!isset($playlist)): ?>
<?php echo $__env->make('Includes.Panel.playlistmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">Add PlayList </h5>
                <hr />
            </div>
            <form id="add-blog" method="post" <?php if(isset($playlist)): ?> action="<?php echo e(route('Panel.EditPlayList',$playlist)); ?>" <?php else: ?>
                action="<?php echo e(route('Panel.AddPlayList')); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for=""><span class="text-danger">*</span> Name : </label>
                                <input required type="text" class="form-control" name="name" id="name"
                                    value="<?php echo e($playlist->name ?? ''); ?>" placeholder="" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-5">
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""><span class="text-danger">*</span> Poster: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px" src="<?php if(isset($playlist)): ?>
                                             <?php echo e(asset($playlist->image)); ?> 
                                                <?php else: ?>
                                                 <?php echo e(asset('assets/images/640x360.png')); ?> 
                                            <?php endif; ?>">
                                        <input type="file" name="poster" id="poster" <?php if(!isset($playlist)): ?> required
                                            <?php endif; ?> />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">Information: </label>
                                <textarea class="form-control" name="bio" id="bio" cols="30"
                                    rows="8"><?php echo e($playlist->information ?? ''); ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""><span class="text-danger">*</span> Add Songs: </label>
                                <select name="songs[]" class="js-example-basic-single" multiple dir="rtl">
                                    <?php $__currentLoopData = \App\Post::where('type','music')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $song): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($song->id); ?>"
                                        <?php echo e(isset($playlist) && $playlist->tracks()->pluck('id')->contains($song->id) ? 'selected' : ''); ?>>
                                        <?php echo e($song->title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <?php if(isset($playlist)): ?>
                            Edit PlayList
                            <?php else: ?>
                            Add PlayList
                            <?php endif; ?>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.min.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/vendors/datepicker/bootstrap-datepicker.min.js')); ?>"></script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Panel/PlayList/Add.blade.php ENDPATH**/ ?>