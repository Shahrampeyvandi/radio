<?php $__env->startSection('content'); ?>
<?php if(!isset($artist)): ?>
<?php echo $__env->make('Includes.Panel.artistmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">Add Artist </h5>
                <hr />
            </div>
            <form id="add-blog" method="post" <?php if(isset($artist)): ?> action="<?php echo e(route('Panel.EditArtist',$artist)); ?>" <?php else: ?>
                action="<?php echo e(route('Panel.AddArtist')); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for=""> Full Name : </label>
                                <input required type="text" class="form-control" name="name" id="name"
                                    value="<?php echo e($artist->fullname ?? ''); ?>" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""> Role : </label>
                                <select name="role" id="role" class="form-control custom-control">
                                    <option value="Singer"
                                        <?php echo e(isset($artist) && $artist->role == 'singer' ? 'selected' : ''); ?>>Singer
                                    </option>
                                    <option value="Writer"
                                        <?php echo e(isset($artist) && $artist->role == 'writer' ? 'selected' : ''); ?>>Writer
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-5">
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> Photo: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px" src="<?php if(isset($artist)): ?>
                                             <?php echo e(asset(unserialize($artist->photo)['resize'])); ?> 
                                                <?php else: ?>
                                                 <?php echo e(asset('assets/images/image-placeholder.jpg')); ?> 
                                            <?php endif; ?>">
                                        <input type="file" name="poster" id="poster" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">Biography: </label>
                                <textarea class="form-control" name="bio" id="bio" cols="30"
                                    rows="8"><?php echo e($artist->bio ?? ''); ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">BirthDay: </label>
                                <input type="text" class="form-control  datepicker" name="birthday" id="birthday"
                                    <?php if(isset($artist)): ?>
                                    value="<?php echo e(\Carbon\Carbon::parse($artist->birthday)->format('d F Y')); ?>" <?php endif; ?>>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="custom-control custom-checkbox custom-control-inline ">
                                    <input type="checkbox" id="popular" name="popular" value="1"
                                        class="custom-control-input " <?php if(isset($artist) && $artist->popular == 1): ?> checked <?php endif; ?>>
                                    <label class="custom-control-label" for="popular">Add To Popular Artists</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            <?php if(isset($artist)): ?>
                            ویرایش
                            <?php else: ?>
                            ثبت
                            <?php endif; ?>
                            اطلاعات </button>
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
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\radio\resources\views/Panel/Artist/Add.blade.php ENDPATH**/ ?>