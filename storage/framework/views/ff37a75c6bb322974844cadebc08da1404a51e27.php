<div class="col-md-4">
    


    <div class="row">
        <div class="form-group col-md-12">
            <label for=""> Singer: </label>
            <select name="singers[]" class="js-example-basic-single" multiple dir="rtl" required>
                <?php $__currentLoopData = $singers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($singer->id); ?>"
                    <?php echo e(isset($post) && $post->artists->pluck('id')->contains($singer->id) ? 'selected' : ''); ?>>
                    <?php echo e($singer->fullname); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-12">
            <label for=""> Writer: </label>
            <select name="writers[]" class="js-example-basic-single" multiple dir="rtl">
                <?php $__currentLoopData = $writers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($writer->id); ?>"
                    <?php echo e(isset($post) && $post->artists->pluck('id')->contains($writer->id) ? 'selected' : ''); ?>>
                    <?php echo e($writer->fullname); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>
    
    <h6 class="">Album: </h6>
    <div class="album row mb-3">
        <div class="col-md-12">

            <select name="albums[]" class="js-example-basic-single" multiple dir="rtl">
                <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($album->id); ?>"
                    <?php echo e(isset($post) && $post->albums->pluck('id')->contains($album->id) ? 'selected' : ''); ?>>
                    <?php echo e($album->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>


    
    



<h6 class="">Categories: </h6>
<div class="cat row">
    <div class="col-md-12">
        <div class="d-flex">
            <input type="text" class="form-control mb-2" name="" id="category" placeholder="name">
        </div>
        <a href="#" class="btn btn-sm btn-primary mb-3"
            onclick="addCategory(event,'<?php echo e(route('Panel.AddCatAjax')); ?>')">add</a>
        <div class="cat-wrapper  card pr-2" style=" min-height:50px;max-height: 200px;overflow-y: scroll;">
             <div class="custom-control custom-radio custom-control-inline ">
            <input type="radio" id="catego" name="category" value=""
                    class="custom-control-input" 
                    checked>
                <label class="custom-control-label" for="catego">No Category</label>
             </div>
            <?php $__currentLoopData = \App\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="custom-control custom-radio custom-control-inline ">
               <?php if($item->id !== 2 && $item->id !== 3): ?> 
                <a href="#" class="delete-tag"
                    onclick="deleteCategory(event,'<?php echo e($item->id); ?>','<?php echo e(route('DeleteCategory')); ?>')"><i
                        class="fa fa-times"></i>
                </a>
               <?php endif; ?>
                <input type="radio" id="category-<?php echo e($key+1); ?>" name="category" value="<?php echo e($item->name); ?>"
                    class="custom-control-input scategory" <?php if(isset($post)): ?>
                    <?php echo e($post->categories->pluck('id')->contains($item->id) ? 'checked' : ''); ?> <?php endif; ?>>
                <label class="custom-control-label" for="category-<?php echo e($key+1); ?>"><?php echo e($item->name); ?></label>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>




<h6 class="">Arrangements: </h6>
<div class="cat row">
    <div class="col-md-12">
        <div class="d-flex">
            <input type="text" class="form-control mb-2" name="" id="arrangement" placeholder="name">
        </div>
        <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addArrangement(event)">add</a>
        <div class="arrangement-wrapper  card pr-2" style=" min-height:50px;max-height: 200px;overflow-y: scroll;">
            <?php $__currentLoopData = \App\Arrangement::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="custom-control custom-checkbox custom-control-inline ">
                <a href="#" class="delete-tag"
                    onclick="deleteArrangement(event,'<?php echo e($item->id); ?>','<?php echo e(route('DeleteArrangement')); ?>')"><i
                        class="fa fa-times"></i>
                </a>
                <input type="checkbox" id="arrangement-<?php echo e($key+1); ?>" name="arrangements[]" value="<?php echo e($item->name); ?>"
                    class="custom-control-input sarrangement" <?php if(isset($post)): ?>
                    <?php echo e($post->arrangements->pluck('id')->contains($item->id) ? 'checked' : ''); ?> <?php endif; ?>>
                <label class="custom-control-label" for="arrangement-<?php echo e($key+1); ?>"><?php echo e($item->name); ?></label>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>



</div><?php /**PATH C:\xampp\htdocs\radio\resources\views/Includes/Panel/MusicSideForm.blade.php ENDPATH**/ ?>