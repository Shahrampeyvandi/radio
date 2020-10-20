     
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.GalleryList')); ?>" class="nav-link 
            <?php if(\Request::route()->getName() == "Panel.GalleryList"): ?> <?php echo e('active'); ?>

             <?php endif; ?>">لیست</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.AddGallery')); ?>" class="nav-link
   <?php if(\Request::route()->getName() == "Panel.AddGallery"): ?> <?php echo e('active'); ?>

    <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
        </li>
</ul>
     
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\radio\resources\views/Includes/Panel/Gallerymenu.blade.php ENDPATH**/ ?>