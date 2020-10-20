<?php $__env->startSection('title',$title); ?>
<?php $__env->startSection('main'); ?>
<?php echo $__env->make('Includes.Front.BreadCrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="container">
    <div class="row">
        <div class="col-12 col-md-9 pb-3 justify-content-center text-center">
            <div class="player container">
                <div class="now-playing" style="color:#000">PLAYING x OF y</div>
                <!-- Define the section for displaying details -->
                <div class="row justify-content-center text-center">
                    <div class="details col-12 col-md-6 text-center text-md-left">

                        <div class="track-art" style="background-image: URL(images/e6e89cad2c87230.jpg);"></div>
                        <div class="music-description">
                            <div class="track-name">Track Name</div>
                            <div class="track-artist">Track Artist</div>
                        </div>
                    </div>
                </div>
                <div class="like text-center">
                    <a class="like-post" data-id="<?php echo e($post->id); ?>"
                        onclick="likePost(event , '<?php echo e(route('Ajax.LikePost')); ?>')">
                        &#10084;
                        &nbsp;&nbsp;
                        <?php echo e(count($post->votes)); ?> Like
                    </a>
                </div>
                <!-- Define the section for displaying the seek slider-->
                <div class="slider_container">
                    <div class="current-time">00:00</div>
                    <input type="range" min="1" max="100" value="0" class="seek_slider" onchange="seekTo()">
                    <div class="total-duration">00:00</div>
                </div>
                <div class="text-center">
                    <!-- Define the section for displaying track buttons -->
                    <div class="buttons">
                        <div class="next-track">
                            <i class="fas fa-random"></i>
                        </div>
                        <div class="prev-track" onclick="prevTrack()">
                            <i class="fas fa-angle-double-left"></i>
                        </div>
                        <div class="playpause-track" onclick="playpauseTrack()">
                            <i class="fas fa-play"></i>
                        </div>
                        <div class="next-track" onclick="nextTrack()">
                            <i class="fas fa-angle-double-right"></i>
                        </div>
                        <a href="<?php echo e(route('DownLoad',$post->id)); ?>" class="download-btn">
                            <i class="fas fa-download"></i>
                        </a>
                    </div>


                    <!-- Define the section for displaying the volume slider-->
                    <div class="slider_container volume_wrapper"
                        style="display: inline-block;width: unset!important;margin-left: 5px;">
                        <i class="fa fa-volume-down"></i>
                        <input type="range" min="1" max="100" value="99" class="volume_slider" onchange="setVolume()">
                        <i class="fa fa-volume-up"></i>
                    </div>
                </div>
                <div class="details-song">
                    <button class="details-btn">
                        <i class="fas fa-caret-right"></i> Details
                    </button>
                    <div class="details-song-inner" style="display: none">
                        <div class="contentInner">
                            <div class="mp3Description">
                                <div class="views">Plays: <?php echo e($post->views ?? ''); ?></div>
                                <div pubdate="pubdate" class="dateAdded">
                                    <?php if($post->released): ?>
                                    Released: <?php echo e($post->released); ?>

                                    <?php endif; ?>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 music-cart-h-wrapper pl-md-0">

            <dl class="tabs" data-tab="">
                <dd class="active tab tab-b-con"><a class="tab-b" href="#this_month">related</a></dd>
                <dd class="tab tab-b-con"><a class="tab-b" href="#this_week">lyrics</a></dd>
            </dl>
            <div class="panel1 play-list" id="this_month">
                <div class="music-cart-h" data-tr="1">
                    <a href="#">
                        <div class="music-cart">
                            <img src="" />
                            <div class="img-cover"></div>
                            <div class="img-cover-player">
                                <span class="ch-1 ch"></span>
                                <span class="ch-2 ch"></span>
                                <span class="ch-3 ch"></span>
                                <span class="ch-4 ch"></span>
                            </div>
                        </div>
                        <div class="songInfo center">
                            <span class="artist"></span>
                            <span class="song"></span>
                            <span class="tag plus"> + </span>
                        </div>
                    </a>
                </div>


            </div>
            <div class="panel1" id="this_week" style="display: none">
                <span class="lyrics-span">



                </span>
            </div>
        </div>

    </div>


</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script
    src="<?php echo e(asset('frontend/assets/Generic-Mobile-friendly-Slider-Plugin-with-jQuery-touchSlider/jquery.touchSlider.js')); ?>">
</script>

<script>
    var prevScrollpos = window.pageYOffset;
    window.onscroll = function () {
        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbar").style.top = "0";
            document.getElementById("navbar").classList.remove("top-100");
            document.getElementById("navmenu").classList.remove("mystyle");
        } else {
            document.getElementById("navbar").style.top = "-50px";
            document.getElementById("navbar").classList.add("top-100")
            document.getElementById("navmenu").classList.add("mystyle")
        }
        prevScrollpos = currentScrollPos;
    }

    $('#touchSlider5').touchSlider({
        view: 3,
        gap: 0,
        breakpoints: {
            640: {
                view: 1,
                gap: 0
            },
            375: {
                view: 1,
                gap: 0
            }
        }
    });

    $(".tab-c").on('click', function (e) {
        e.preventDefault()
        tabs = $(this).attr("href")
        $(".panel2").hide()
        $(tabs).show()
        $(".tab-c-con").removeClass("active")
        $(this).parent().addClass("active")

    })
    $(".tab-b").on('click', function (e) {
        e.preventDefault()
        tabs = $(this).attr("href")
        $(".panel1").hide()
        $(tabs).show()
        $(".tab-b-con").removeClass("active")
        $(this).parent().addClass("active")

    })


    // Select all the elements in the HTML page
    // and assign them to a variable
    let now_playing = document.querySelector(".now-playing");
    let track_art = document.querySelector(".track-art");
    let track_name = document.querySelector(".track-name");
    let track_artist = document.querySelector(".track-artist");

    let playpause_btn = document.querySelector(".playpause-track");
    let next_btn = document.querySelector(".next-track");
    let prev_btn = document.querySelector(".prev-track");

    let seek_slider = document.querySelector(".seek_slider");
    let volume_slider = document.querySelector(".volume_slider");
    let curr_time = document.querySelector(".current-time");
    let total_duration = document.querySelector(".total-duration");

    // Specify globally used values
    let track_index = 0;
    let isPlaying = false;
    let updateTimer;

    // Create the audio element for the player
    let curr_track = document.createElement('audio');
    // Define the list of tracks that have to be played
    var track_list =JSON.parse(<?php echo json_encode($track_lists, 15, 512) ?>)
    
    
    ajaxurl = "<?php echo e(route("S.addToFavorite")); ?>"
    htmlMaker = ''
    i = 0
    track_list.forEach(function (item) {
        htmlMaker += `<div class="music-cart-h" data-tr="${i}">
                               <a href="#" onclick="playItem(${i})">
                                   <div class="music-cart">
                                       <img src="${item.image}"/>
                                       <div class="img-cover"></div>
                                       <div class="img-cover-player" style="display: none">
                                           <span class="ch-1 ch"></span>
                                           <span class="ch-2 ch"></span>
                                           <span class="ch-3 ch"></span>
                                           <span class="ch-4 ch"></span>
                                       </div>
                                   </div>
                                   <div class="songInfo center">
                                       <span class="artist" title="Baran">${item.name}</span>
                                       <span class="song" title="Migzaroonam">${item.artist}</span>
                                       
                                   </div>
                               </a>
                               
                               <a href="#" onclick="call(event)" data-id="${item.id}" data-type="music" class="add-favorite plus"> 
                                +
                                </a>
                           </div>`
        i++
    })
    jQuery('.play-list').html(htmlMaker)


    function loadTrack(track_index) {
        // Clear the previous seek timer
        clearInterval(updateTimer);
        resetValues();

        // Load a new track
        curr_track.src = track_list[track_index].path;
        curr_track.load();

        // Update details of the track
        track_art.style.backgroundImage =
            "url("+ track_list[track_index].image + ")";
        track_name.textContent = track_list[track_index].name;
        track_artist.textContent = track_list[track_index].artist;
        now_playing.textContent = "PLAYING " + (track_index + 1) + " OF " + track_list.length;
        jQuery('.lyrics-span').html(track_list[track_index].lyric)
        jQuery('.like-post').attr('data-id',track_list[track_index].id)
        jQuery('.like-post').html(`<i class="fas fa-heart"></i>${track_list[track_index].likes} Like`)
        jQuery('.views').html(`Plays: ${track_list[track_index].views}`)
        jQuery('.download-btn').attr('href',mainUrl + '/download/' +track_list[track_index].id)     
        if (track_list[track_index].released !== null) {
            jQuery('.dateAdded').html(`Released: ${track_list[track_index].released}`)
        }      
        // Set an interval of 1000 milliseconds
        // for updating the seek slider
        updateTimer = setInterval(seekUpdate, 1000);

        // Move to the next track if the current finishes playing
        // using the 'ended' event
        curr_track.addEventListener("ended", nextTrack);

        // Apply a random background color
        random_bg_color();
    }
    
function likePost(event,url) {
    event.preventDefault()
    post_id = $(event.target).closest(".like-post").attr('data-id');
        var request = $.post(url, {
            post_id: post_id,
            _token: token
        });
        request.done(function(res) {
            
            if(res.error) {
                 var jbox =  new jBox('Modal', {
                    attach: '.openModal',
                    minWidth:300,
                    content: 'You must  <a href="'+mainUrl+'/login" class="text-gray">login </a> to add to playlist.'
                 })
                 jbox.open()
             }
            if(res.status) {
                $(event.target).closest(".like-post").html(` &#10084;
                             ${res.likes + 1} Like`);
             track_list[track_index].likes++;
         }else{
             
         }
        });
}

    function random_bg_color() {
        // Get a random number between 64 to 256
        // (for getting lighter colors)
        let red = Math.floor(Math.random() * 256) + 64;
        let green = Math.floor(Math.random() * 256) + 64;
        let blue = Math.floor(Math.random() * 256) + 64;

        // Construct a color withe the given values
        let bgColor = "rgb(" + red + ", " + green + ", " + blue + ")";

        // Set the background to the new color
        // document.body.style.background = bgColor;
    }

    // Functiom to reset all values to their default
    function resetValues() {
        curr_time.textContent = "00:00";
        total_duration.textContent = "00:00";
        seek_slider.value = 0;
    }

    function playpauseTrack() {
        // Switch between playing and pausing
        // depending on the current state
        if (!isPlaying) playTrack();
        else pauseTrack();

    }

    function  addPlayCount() {
        var url = mainUrl + '/addplaycount'
        var track_id = track_list[track_index].id;
        var request = $.post(url, {
        _token: token,
        track_id:track_id
    });
    request.done(function(res) {
        //  if (res.length > 0) {
        //      $(".ac_results").fadeIn();
        //      $(".ac_results ul").html(res);
        //  }
    });
    }

    function playTrack() {
        // Play the loaded track
       
        curr_track.play();
        isPlaying = true;
        // Replace icon with the pause icon
        playpause_btn.innerHTML = '<i class="fas fa-pause"></i>';
        addPlayCount();

    }

    function pauseTrack() {
        // Pause the loaded track
        curr_track.pause();
        isPlaying = false;

        // Replace icon with the play icon
        playpause_btn.innerHTML = '  <i class="fas fa-play"></i>';
        ;
    }

    function playItem(track_index) {
        loadTrack(track_index);
        playTrack();
        jQuery('.img-cover-player').hide()
        jQuery('.music-cart-h[data-tr=' + track_index + ']').find('.img-cover-player').show()
    }

    function nextTrack() {
        // Go back to the first track if the
        // current one is the last in the track list
        if (track_index < track_list.length - 1)
            track_index += 1;
        else track_index = 0;

        // Load and play the new track
        loadTrack(track_index);
        playTrack();
        jQuery('.img-cover-player').hide()
        jQuery('.music-cart-h[data-tr=' + track_index + ']').find('.img-cover-player').show()
        jQuery('.lyrics-span').html(track_list[track_index].lyric)
    
    }

    function prevTrack() {
        // Go back to the last track if the
        // current one is the first in the track list
        if (track_index > 0)
            track_index -= 1;
        else track_index = track_list.length;

        // Load and play the new track
        loadTrack(track_index);
        playTrack();
        jQuery('.img-cover-player').hide()
        jQuery('.music-cart-h[data-tr=' + track_index + ']').find('.img-cover-player').show()
    }

    function seekTo() {
        // Calculate the seek position by the
        // percentage of the seek slider
        // and get the relative duration to the track
        seekto = curr_track.duration * (seek_slider.value / 100);

        // Set the current track position to the calculated seek position
        curr_track.currentTime = seekto;
    }

    function setVolume() {
        // Set the volume according to the
        // percentage of the volume slider set
        curr_track.volume = volume_slider.value / 100;
    }

    function seekUpdate() {
        let seekPosition = 0;

        // Check if the current track duration is a legible number
        if (!isNaN(curr_track.duration)) {
            seekPosition = curr_track.currentTime * (100 / curr_track.duration);
            seek_slider.value = seekPosition;

            // Calculate the time left and the total duration
            let currentMinutes = Math.floor(curr_track.currentTime / 60);
            let currentSeconds = Math.floor(curr_track.currentTime - currentMinutes * 60);
            let durationMinutes = Math.floor(curr_track.duration / 60);
            let durationSeconds = Math.floor(curr_track.duration - durationMinutes * 60);

            // Add a zero to the single digit time values
            if (currentSeconds < 10) {
                currentSeconds = "0" + currentSeconds;
            }
            if (durationSeconds < 10) {
                durationSeconds = "0" + durationSeconds;
            }
            if (currentMinutes < 10) {
                currentMinutes = "0" + currentMinutes;
            }
            if (durationMinutes < 10) {
                durationMinutes = "0" + durationMinutes;
            }

            // Display the updated duration
            curr_time.textContent = currentMinutes + ":" + currentSeconds;
            total_duration.textContent = durationMinutes + ":" + durationSeconds;
        }
    }
    loadTrack(track_index);
   
    jQuery('.music-cart-h[data-tr=' + track_index + ']').find('.img-cover-player').show()
    $('.details-btn').on('click', function () {

        display = ($('.details-song-inner').css('display'))

        $('.details-song-inner').slideToggle()

        if (display == 'none') {
            $('.details-btn > i').css({'transform': 'rotate(90deg)'})
        }
        if (display == 'block') {
            $('.details-btn > i').css({'transform': 'rotate(0)'})
        }
    })

    $('.login_modal_lbl').on('click', function (e) {
        $('#login-modal').toggle()
    })


 

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\radio\resources\views/Front/show-music.blade.php ENDPATH**/ ?>