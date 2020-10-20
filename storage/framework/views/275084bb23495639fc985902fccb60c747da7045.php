<?php $__env->startSection('main'); ?>
<div class="container mt-page ">
    <div class="row text-center justify-content-center">
        <div class="col-10 col-md-6">
            <div class="formContainer1 forms">
                <div class="panels">
                    <div class="leftPanel emptyState">
                        <i class="fa fa-user "></i>
                    </div>
                    <div class="rightPanel">
                        <div class="titleContainer" style="margin-bottom: 20px">
                            <h3 class="title dark">Edit Profile</h3>
                            <?php if(count($errors)): ?>
                            <h6 class="text-danger">
                                <?php echo e($errors->first()); ?>

                            </h6>
                            <?php endif; ?>
                        </div>
                        <div id="">
                            <div id="">
                                <form id="profile" class="parsley-validate" action="<?php echo e(route('Profile')); ?>" method="post" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="text" name="email" id="email" value="<?php echo e($user->email ?? ''); ?>"
                                        placeholder="*Email" readonly>
                                    <input type="text" name="mobile" id="mobile" value="<?php echo e($user->mobile ?? ''); ?>"
                                        placeholder="Mobile">
                                    <input type="text" name="password" id="password" placeholder="New Password">
                                    <input type="text" name="cpassword" id="cpassword" placeholder="Confirm Password">
                                    <div class="photo text-left">
                                        <?php if($user->avatar): ?>
                                        <img src="<?php echo e(asset($user->avatar)); ?>" alt="Default profile thumb"
                                            style="width: 100px">
                                        <?php else: ?>
                                        <img src="https://d1eqqkloubk286.cloudfront.net/static/profiles/default-profile-thumb.jpg"
                                            alt="Default profile thumb" style="width: 100px">
                                        <?php endif; ?>
                                        <input type="file" name="photo" id="photo" class="mt-2">
                                    </div>
                                    <div style="margin-top: 10px">
                                        <button type="submit" class="submit-button">Confirm</button>
                                        <div class="alert-box alert form_error twelve columns" style="display: none">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp1\htdocs\radio\resources\views/Front/profile.blade.php ENDPATH**/ ?>