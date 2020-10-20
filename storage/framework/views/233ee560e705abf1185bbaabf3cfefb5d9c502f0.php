<?php $__env->startSection('content'); ?>

<?php echo $__env->make('Includes.Panel.Gallerymenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">Add Photos Gallery</h5>
                <hr />
            </div>
            <form id="upload-file" method="post" action="<?php echo e(route('Panel.AddGallery')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(isset($post)): ?>
                <?php echo method_field('PUT'); ?>
                <input type="hidden" name="post_id" id="post_id" value="<?php echo e($post->id); ?>">
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""> Title: </label>
                                <input type="text" class="form-control" name="title" id="title" required
                                    value="<?php echo e($post->name ?? ''); ?>" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span style="cursor: pointer;" href="">
                                    Poster: </span>

                                <div class="row">
                                    <div class=" col-md-6 image-box">
                                        <div class="form-group">
                                            <input required type="file" name="poster" class="dropify"
                                                data-max-file-size="1000K" data-allowed-file-extensions="png jpg jpeg"
                                                data-default-file="" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <label for="desc">Images: </label>
                        <?php if(isset($post)): ?>
                        <div class="row">
                            <?php $__currentLoopData = $post->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class=" col-md-3">
                                <a style="cursor: pointer;color:red" onclick="removeImage(event,<?php echo e($image->id); ?>)"><i
                                        class="fas fa-trash"></i></a>
                                <img width="100%" src="<?php echo e(asset($image->url)); ?>" alt="">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php endif; ?>
                        <span style="cursor: pointer;" href="" onclick="getClone(this)"><i class="fa fa-plus"></i>
                            add image </span>

                        <div class="row">
                            <div class=" col-md-3 image-box">
                                <div class="form-group">
                                    <input required type="file" name="images[]" class="dropify"
                                        data-max-file-size="300K" data-allowed-file-extensions="png jpg jpeg"
                                        data-default-file="" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary"> Save </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('js'); ?>
<script>
    function removeImage (event,id) {
            event.preventDefault()
            var target =$(event.target)
            data = { id:id, _method: 'delete',_token: "<?php echo e(csrf_token()); ?>" };
            url='<?php echo e(route('Panel.DeleteImage')); ?>';
            request = $.post(url, data);
            request.done(function(res){
            target.parents('.col-md-3').remove()
        });
            }
              
               
              

           
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Panel/Photos/add.blade.php ENDPATH**/ ?>