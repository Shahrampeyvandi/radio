     
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.VideoList')); ?>" class="nav-link 
            <?php if(\Request::route()->getName() == "Panel.VideoList"): ?> <?php echo e('active'); ?>

             <?php endif; ?>">لیست</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.AddVideo')); ?>" class="nav-link
   <?php if(\Request::route()->getName() == "Panel.AddVideo"): ?> <?php echo e('active'); ?>

    <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
        </li>
</ul>
     
    </div>
</div>
<?php /**PATH C:\xampp1\htdocs\radio\resources\views/Includes/Panel/moviesmenu.blade.php ENDPATH**/ ?>