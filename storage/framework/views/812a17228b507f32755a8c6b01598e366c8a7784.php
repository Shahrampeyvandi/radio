<header>
    <div class="top-header" id="navbar">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-4 ">
                 
                </div>
                <div class="col-6 col-md-4 pt-2 pt-md-0  text-md-center text-right justify-content-center align-middle">
                    <div>
                        <div class="search-box align-middle">
                            <label>
                                <svg xmlns="http://www.w3.org/2000/svg" height="136pt" version="1.1"
                                    viewBox="-1 0 136 136.21852" width="136pt">
                                    <g id="surface1">
                                        <path
                                            d="M 93.148438 80.832031 C 109.5 57.742188 104.03125 25.769531 80.941406 9.421875 C 57.851562 -6.925781 25.878906 -1.460938 9.53125 21.632812 C -6.816406 44.722656 -1.351562 76.691406 21.742188 93.039062 C 38.222656 104.707031 60.011719 105.605469 77.394531 95.339844 L 115.164062 132.882812 C 119.242188 137.175781 126.027344 137.347656 130.320312 133.269531 C 134.613281 129.195312 134.785156 122.410156 130.710938 118.117188 C 130.582031 117.980469 130.457031 117.855469 130.320312 117.726562 Z M 51.308594 84.332031 C 33.0625 84.335938 18.269531 69.554688 18.257812 51.308594 C 18.253906 33.0625 33.035156 18.269531 51.285156 18.261719 C 69.507812 18.253906 84.292969 33.011719 84.328125 51.234375 C 84.359375 69.484375 69.585938 84.300781 51.332031 84.332031 C 51.324219 84.332031 51.320312 84.332031 51.308594 84.332031 Z M 51.308594 84.332031 "
                                            style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;" />
                                    </g>
                                </svg>
                            </label>
                        <input type="text" placeholder="search" oninput="getResult(event,'<?php echo e(route('Ajax.Search')); ?>')">
                        </div>
                        <div class="ac_results"
                            style="position: absolute; width: 300px; top: 40px; left: 634.5px; display: none;">
                            <ul style="max-height: 250px; overflow: auto;">
                                
                              
                              
                                
                              
                    
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-5 col-md-4 border-top-my d-inline-block d-md-none">
                    <div class="logo">
                        <a class="logo-url" href="<?php echo e(route('MainUrl')); ?>">
                            <img src="<?php echo e(asset('frontend/images/logo radioavin- png2.png')); ?>"
                                height="38" width="172" />
                        </a>
                    </div>
                </div>
                <div class="col-7 col-md-4 border-top-my pr-">
                    <ul class="top-header-menu text-right">
                       
                        <?php if(auth()->guard()->check()): ?>
                        <li class="d-none d-md-block">
                            <button class="profile-icon" aria-describedby="ui-tooltip-1">
                                <i class="fa fa-user"></i>
                            </button>
                        </li>
                        <div class="profile-content hidden">
                            <h5>WelCome </h5>
                            <h6 class="pb-2"><?php echo e(explode('@',auth()->user()->email)[0]); ?></h6>
                            <div class="user-links">
                            <a href="<?php echo e(route('Profile')); ?>">Profile</a>
                                <a href="<?php echo e(route('logout-user')); ?>">Logout</a>
                            </div>
                        </div>
                        <?php else: ?>
                        <li class="position-relative">
                            <span class="login_modal_lbl">Log In</span>
                            <div id="login-modal" style="display: none">
                                <div id="user_account_dropdown">
                                    <form id="login_form" action="<?php echo e(route('login')); ?>" accept-charset="UTF-8"
                                        method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="text" name="username" id="username" placeholder="User Name"
                                            required>
                                        <input type="password" name="password" id="Password" placeholder="Password"
                                            class="twelve" required>
                                        <button type="submit" class="submit-button">Login</button>
                                    </form>
                                    <hr>
                                    <div id="login_signup">
                                        Don't have an account?
                                        <a href="<?php echo e(route('S.Register')); ?>" data-no-turbolink="data-no-turbolink"
                                            class="button linkButton">Sign Up</a>
                                    </div>
                                    <hr>

                                    <hr>
                                    <div id="login_forgot">
                                        <a href="/account/forgot" data-no-turbolink="data-no-turbolink"
                                            class="button textButton">Forgot your password?</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="<?php echo e(route('S.Register')); ?>">Sign Up</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container justify-content-between" id="navmenu">
        <div class="row justify-content-between nav-menu overflow-hidden">
            <div class="nav-menu-logo">
                <div class="logo">
                    <a class="logo-url" href="<?php echo e(route('MainUrl')); ?>">
                        <img src="<?php echo e(asset('frontend/images/logo_radioavin.png')); ?>"
                            height="38" width="172" />
                    </a>
                </div>

            </div>
            <div class="nav-main-menu">
                <nav>
                    <ul>
                         <li><a href="<?php echo e(route('MainUrl')); ?>">Home</a></li>
                        <li><a href="<?php echo e(route('Mp3s')); ?>">Music</a></li>
                        <li><a href="<?php echo e(route('Playlists')); ?>">PlayList</a></li>
                        <li><a href="<?php echo e(route('Videos')); ?>">Videos</a></li>
                        
                        
                        <!-- <li><a href="#">Music</a></li> -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header><?php /**PATH C:\xampp1\htdocs\radio\resources\views/Includes/Front/Header.blade.php ENDPATH**/ ?>