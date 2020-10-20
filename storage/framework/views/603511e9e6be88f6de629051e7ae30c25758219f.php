<?php $__env->startSection('Title','صفحه اصلی'); ?>


<?php $__env->startSection('content'); ?>

<?php echo $__env->make('Includes.Front.Header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('Includes.Front.DesktopSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Includes.Front.MobileSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="top-slider">
    <div class="swiper-container TopSlider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="top-slider-box">
                    <a href="#">
                        <img src="<?php echo e(asset('frontend/assets/images/section-sliders/p1.jpg')); ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="top-slider-box">
                    <a href="#">
                        <img src="<?php echo e(asset('frontend/assets/images/section-sliders/p1.jpg')); ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="top-slider-box">
                    <a href="#">
                        <img src="<?php echo e(asset('frontend/assets/images/section-sliders/p1.jpg')); ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="top-slider-box">
                    <a href="#">
                        <img src="<?php echo e(asset('frontend/assets/images/section-sliders/p1.jpg')); ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="top-slider-box">
                    <a href="#">
                        <img src="<?php echo e(asset('frontend/assets/images/section-sliders/p1.jpg')); ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="top-slider-box">
                    <a href="#">
                        <img src="<?php echo e(asset('frontend/assets/images/section-sliders/p1.jpg')); ?>" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<section class="movie-sections">
    <h3>
        تازه ترین سریال ها
        <a href="#">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $newseries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <a href="#" data-id="1" onclick="showDetails(event,'<?php echo e($serie->id); ?>','<?php echo e(route('GetMovieDetail')); ?>')">
                    <div class="movie-sections-box">
                        <div class="img-box-movies">
                            <img src="<?php echo e(asset($serie->poster)); ?>" alt="<?php echo e($serie->name); ?>">
                            <div class="cover-img-movies-details">
                                <span>
                                    <?php echo e($serie->name); ?> -
                                    <?php echo e(\Morilog\Jalali\Jalalian::forge($serie->first_publish_date)->format('%Y')); ?>

                                </span>
                                <span>
                                    <i class="fa fa-heart"></i>
                                    89%
                                </span>
                            </div>
                        </div>
                        <h5>
                            <?php echo e($serie->title); ?>

                        </h5>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <div class="movie-detail-show_index" style=" background: url('../images/آقازاده.jpg') no-repeat;    background-size: contain;">
        <div class="details_movie_index">
            <div class="cover-movie-detail_index"></div>
            <a>
                <h1>
                    دل
                </h1>
                <div class="desc mt-2 w-50">
                    توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات
                    توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات توضیحات
                </div>
               <div>
                    <a href="#" class="page-movie-play btn--ripple mr-0 mt-5">
                    <i class="fa fa-play"></i>
                    پخش فیلم
                </a>
                <a href="./moviePage.html" class="more-detail-movie btn--ripple">
                    <i class="fa fa-exclamation"></i>
                    توضیحات بیشتر
                </a>
               </div>
                <h6>
                    ستارگان:
                    <a href="#">
                        ستاره 1
                    </a>
                </h6>
                <h6>
                    دسته بندی:
                    <a href="#">
                        دسته بندی 1 -
                    </a>
                </h6>
            </a>
        </div>
    </div>
</section>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-3">
                <div class="footer-elements">
                    <a href="#">
                        درباره نماوا
                    </a>
                    <a href="#">
                        درباره نماوا
                    </a>
                    <a href="#">
                        درباره نماوا
                    </a>
                    <a href="#">
                        درباره نماوا
                    </a>
                    <a href="#">
                        درباره نماوا
                    </a>
                </div>
            </div>
            <div class="col-3">
                <div class="footer-elements">
                    <a href="#">
                        درباره نماوا
                    </a>
                    <a href="#">
                        درباره نماوا
                    </a>
                    <a href="#">
                        درباره نماوا
                    </a>
                    <a href="#">
                        درباره نماوا
                    </a>
                    <a href="#">
                        درباره نماوا
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10">
                <div class="footer-sharing">
                    <a href="#">
                        <div class="sharing">
                            <i class="fab fa-telegram-plane"></i>
                        </div>
                    </a>
                    <a href="#">
                        <div class="sharing">
                            <i class="fab fa-instagram"></i>
                        </div>
                    </a>
                    <a href="#">
                        <div class="sharing">
                            <i class="fab fa-twitter"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <p class="footer-text">
        خدمات ارایه شده در نماوا، دارای مجوز های لازم از مراجع مربوطه می باشد و هر گونه بهره برداری و سوء استفاده از
        محتوای نماوا، پیگرد قانونی دارد.
    </p>
</footer>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/index.blade.php ENDPATH**/ ?>