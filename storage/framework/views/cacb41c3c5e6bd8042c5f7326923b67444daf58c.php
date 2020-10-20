
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
            <a href="<?php echo e(route('Panel.MusicList')); ?>" class="nav-link 
            <?php if(\Request::route()->getName() == "Panel.MusicList"): ?> <?php echo e('active'); ?> 
            <?php endif; ?>">لیست</a>
        </li>
        <li class="nav-item">
            <a href="<?php echo e(route('Panel.AddMusic')); ?>" class="nav-link
   <?php if(\Request::route()->getName() == "Panel.AddMusic"): ?> <?php echo e('active'); ?> 
   <?php endif; ?>">جدید <i class="fas fa-plus"></i></a>
        </li>
          
</ul>
 </div>
</div>
<?php /**PATH C:\xampp1\htdocs\radio\resources\views/Includes/Panel/seriesmenu.blade.php ENDPATH**/ ?>