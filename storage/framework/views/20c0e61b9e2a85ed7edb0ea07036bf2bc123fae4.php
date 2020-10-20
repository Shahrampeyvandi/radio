 <header>
        <div class="cover-menu"></div>
        <nav class="siteNav">
            <div class="navBar">
                <div class="menu-button">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
                </div>
                <ul class="navList">
                    <li class="navItem logo">
                        <a href="index.html">
                            LOGO
                        </a>
                    </li>
                    <li class="navItem">
                        <a href="index.html" class="active-nav">
                            <i class="far fa-home"></i>
                            خانه
                        </a>
                    </li>
                    <li class="navItem">
                        <a href="#">
                            <i class="far fa-camera-movie"></i>
                            فیلم ها
                        </a>
                    </li>
                    <li class="navItem">
                        <a href="#">
                            <i class="fa fa-tv"></i>
                            سریال ها
                        </a>
                    </li>
                    <li class="navItem">
                        <a href="category.html">
                            <i class="fa fa-cloud"></i>
                            دسته بندی
                        </a>
                    </li>
                    <li class="navItem">
                        <a href="Blog/index.html">
                            <i class="fa fa-fire"></i>
                            وبلاگ
                        </a>
                    </li>
                    <li class="navItem">
                        <a href="#">
                            <i class="fa fa-child"></i>
                            کودکان
                        </a>
                    </li>
                </ul>
                <div class="menu-item-left_nav">
                    <!--                <div class="login-register">-->
                    <!--                    <a href="login_register.html">-->
                    <!--                        ورود / ثبت نام-->
                    <!--                    </a>-->
                    <!--                </div>-->
                    <div class="user-login-show">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <div class="profile-dropdown-box">
                        <ul>
                            <li>
                                <a href="profile.html">
                                    <i class="fa fa-user-circle"></i>
                                    <span>
                                        محمد اکبری
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span>
                                        خرید اشتراک
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-list"></i>
                                    <span>
                                        لیست علاقه مندی ها
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-power-off"></i>
                                    <span>
                                        خروج
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <a href="siteSharing.html" class="buy-subscribe">
                        خرید اشتراک
                    </a>
                    <div id="search-box">
                        <i class="far fa-search"></i>
                    </div>
                   <?php echo $__env->make('Includes.Front.Search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </nav>
    </header><?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Front/Header.blade.php ENDPATH**/ ?>