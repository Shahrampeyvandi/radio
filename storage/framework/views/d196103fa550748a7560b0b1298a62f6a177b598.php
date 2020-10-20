     
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.PlayList')); ?>" class="nav-link 
            <?php if(\Request::route()->getName() == "Panel.PlayList"): ?> <?php echo e('active'); ?>

             <?php endif; ?>">لیست</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.AddPlayList')); ?>" class="nav-link
   <?php if(\Request::route()->getName() == "Panel.AddPlayList"): ?> <?php echo e('active'); ?>

    <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
        </li>
</ul>
     
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\radio\resources\views/Includes/Panel/playlistmenu.blade.php ENDPATH**/ ?>