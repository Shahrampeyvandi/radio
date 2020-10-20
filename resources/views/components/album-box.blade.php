<div class="col-6 col-md-2">
    <div class="music-cart-wrapper scale-play-list p-3 p-sm-2 p-md-1 p-lg-2">
    <a href="{{$album->playurl()}}">
            <div class="music-cart">
                <img src="{{asset($album->image)}}" />
                <div class="img-cover"></div>
            </div>
            <div class="songInfo center">
                <span class="artist" title="{{$album->name}}">{{$album->name}}</span>
                
            </div>
        </a>
    </div>
</div>