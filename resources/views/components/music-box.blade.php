<div class="col-6 col-md-2">
    <div class="music-cart-wrapper scale-play-list p-3 p-sm-2 p-md-1 p-lg-1">
        <a href="{{$item->url()}}">
            <div class="music-cart">
                <img src="{{$item->image('resize')}}" class="size-131" />
                <div class="img-cover"></div>

            </div>
            <div class="songInfo center">
                <span class="artist" title="{{$item->singers()}}">{{$item->singers()}}</span>
                <span class="song" title="{{$item->title}}">{{$item->title}}</span>

            </div>
        </a>
    </div>
<a href="#" onclick="call(event)" data-id="{{$item->id}}" data-type="music" class='add-to-pl plus-button' id="{{$item->id}}"> + </a>
</div>