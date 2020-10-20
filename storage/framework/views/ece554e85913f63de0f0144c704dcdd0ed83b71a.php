<?php $__env->startSection('content'); ?>

<div class="container-fluid">
    <?php if(!isset($post)): ?>
    <?php echo $__env->make('Includes.Panel.seriesmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <div class="card">
        <div class="card-body">
            <form id="upload-music" method="post" <?php if(isset($post)): ?> action="<?php echo e(route('Panel.EditMusic',$post)); ?>" <?php else: ?>
                action="<?php echo e(route('Panel.AddMusic')); ?>" <?php endif; ?> enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="card-title d-flex justify-content-between">
                    <h5 class="text-center">
                        <?php if(isset($post)): ?>
                        Edit Music
                        <?php else: ?>
                        Add Music
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
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="custom-control custom-checkbox custom-control-inline ">
                                    <input type="checkbox" id="podcast" name="podcast" value="1"
                                        class="custom-control-input " <?php if(isset($post)): ?> <?php endif; ?>>
                                    <label class="custom-control-label" for="podcast">Podcast</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""> PlayList: </label>
                                <select name="playlists[]" class="js-example-basic-single" multiple dir="rtl">
                                    <?php $__currentLoopData = $playlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $playlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($playlist->id); ?>"
                                        <?php echo e(isset($post) && $post->playlists()->pluck('id')->contains($playlist->id) ? 'selected' : ''); ?>>
                                        <?php echo e($playlist->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                        </div>
                        <?php echo $__env->make('Includes.Panel.MusicForm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('Includes.Panel.Music', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php echo $__env->make('Includes.Panel.MusicSideForm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <div class="row">
                    <div class="col-md-12 my-2 btn--wrapper text-center">
                        <input type="submit" name="upload" id="upload" value="Upload" class="btn  btn-success" />
                    </div>
                </div>
                <hr>
                <div class="progress">
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

    <script>
        //  $.validator.addMethod('filesize', function (value, element, param) {
        // return this.optional(element) || (element.files[0].size <= param)
        //  }, 'سایز تصویر نمی تواند بیشتر از دو مگابایت باشد');
        // $.validator.addMethod(
        // "regex",
        // function(value, element, regexp) {
        //     return this.optional(element) || regexp.test(value);
        // },
        // "Please check your input."
        // );
    
    </script>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\radio\resources\views/Panel/Music/add.blade.php ENDPATH**/ ?>