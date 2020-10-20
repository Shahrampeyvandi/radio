
    <div class="col-6 col-md-2">
    <div class="music-cart-wrapper scale-play-list p-3 p-sm-2 p-md-1 p-lg-2">
    <a href="{{$video->url()}}">
            <div class="music-cart">
                <img src="{{$video->image('resize')}}" />
             

                <div class="img-cover"></div>
            </div>
            <div class="songInfo center">
                <span class="artist" title="{{$video->singers()}}">{{$video->singers()}}</span>
                <span class="song" title="{{$video->title}}">{{$video->title}}</span>
            </div>
        </a>
    </div>
</div>
