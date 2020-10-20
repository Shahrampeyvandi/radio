@if ($songs)

    <div class="music-cart-wrapper scale-play-list p-3 p-sm-2 p-md-1 p-lg-2">
        <a href="{{$playlist->playurl()}}">
            <div class="music-cart">
                @if(isset($playlist->image) && !is_null($playlist->image))
                <img src="{{asset($playlist->image)}}" />
                @else
                <img src="{{asset('frontend/images/remix.jpg')}}" />
                @endif

                <div class="img-cover"></div>
            </div>
            <div class="songInfo center">
                <span class="artist" title="{{$playlist->name}}">{{$playlist->name}}</span>

            </div>
        </a>
    </div>
@endif