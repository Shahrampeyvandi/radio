<?php $__env->startSection('content'); ?>
 <!-- modals -->

 
<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="add-member" action="<?php echo e(route('Panel.AddUser')); ?>" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">افزودن</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                       
                      <div class="form-group col-md-6">
                         <label for=""> آدرس ایمیل <span class="text-danger">*</span> </label>
                         <input type="text" class="form-control" name="email" id="email" value=""
                             >
                     </div>
                        <div class="form-group col-md-6">
                            <label for="">  شماره موبایل</label>
                            <input type="text" class="form-control" name="mobile" id="mobile" value=""
                                >
                        </div>
                         <div class="form-group col-md-6">
                            <label for=""> <span class="text-danger">*</span>  رمز عبور</label>
                            <input type="text" class="form-control" name="password" id="password" value=""
                                >
                        </div>
                         <div class="form-group col-md-6">
                            <label for=""> <span class="text-danger">*</span>  تایید رمز عبور</label>
                            <input type="text" class="form-control" name="cpassword" id="cpassword" value=""
                                >
                        </div>
                        <div class="form-group col-md-12">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="sendsms" name="sendsms" value="1"
                                        class="custom-control-input" >
                                    <label class="custom-control-label" for="sendsms">
                                        ارسال پیامک آگاه ساز به کاربر</label>
                                </div>

                            </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class=" btn btn-success text-white">ثبت</button>
                </div>
            </div>
        </form>
    </div>
</div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                موارد علامت زده شده حذف شوند؟
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('delete'); ?>
                    <input type="hidden" name="video_id" id="video_id" value="">
                    <a href="#" class="deleteposts btn btn-danger text-white">حذف! </a>
                </form>
            </div>
        </div>
    </div>
</div>

      <div
        class="modal fade bd-example-modal-lg-edit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content edit-modal-user"></div>
        </div>
      </div>

      <!-- end modals -->

      <div class="container-fluid">
        <div class="card">
          <div class="container_icon card-body d-flex justify-content-end">
        <div class="delete-edit" style="display:none;">
            <a href="#" title="حذف " data-toggle="modal" data-target="#exampleModal" class="order-delete   m-2">
                <span class="__icon bg-danger">
                    <i class="fa fa-trash"></i>
                </span>
            </a>
        </div>
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add-user">افزودن <i class="fas fa-plus"></i></a>
    </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h5 class="text-center">مدیریت کاربران</h5>
              <hr />
            </div>
            <div style="overflow-x: auto;">
              <table id="example1" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th></th>
                    <th>ردیف</th>
                    <th>
                     
                        نام
                     
              
                    </th>
                    <th>
                    
                        نام خانوادگی
                     
                    
                    </th>
                    <th>شماره موبایل</th>
                    <th>پروفایل عکس</th>
                  </tr>
                </thead>
                <tbody class="tbody">
                  <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td>
                      <div
                        class="custom-control custom-checkbox custom-control-inline"
                        style="margin-left: -1rem;"
                      >
                        <input
                          data-id="<?php echo e($user->id); ?>"
                          type="checkbox"
                          id="user_<?php echo e($key); ?>"
                          name="customCheckboxInline1"
                          class="custom-control-input"
                          value="1"
                        />
                        <label
                          class="custom-control-label"
                          for="user_<?php echo e($key); ?>"
                        ></label>
                      </div>
                    </td>
                    <td><?php echo e($key+1); ?></td>
                    <td><?php echo e($user->first_name); ?></td>
                    <td><?php echo e($user->last_name); ?></td>
                 
                    <td><?php echo e($user->mobile); ?></td>
                    <td>
                      <?php if($user->avatar !== '' &&
                      $user->avatar !== null ): ?> <img width="75px"
                      class="img-fluid " src="
                      <?php echo e(asset("uploads/brokers/$user->avatar")); ?> " />
                      <?php else: ?> <img width="75px" class="img-fluid " src="
                      <?php echo e(asset("assets/images/avatar.png")); ?> " /> <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Panel', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Panel/Users/Lists.blade.php ENDPATH**/ ?>