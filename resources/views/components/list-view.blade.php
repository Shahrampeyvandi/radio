<div class="music-cart-h ">
    <a href="{{$item->url()}}">
        <div class="music-cart">
            <img src="{{$item->image('resize')}}" />

            <div class="img-cover"></div>

        </div>
        <div class="songInfo center">
            <span class="artist" title="{{$item->singers()}}">{{$item->singers()}}</span>
            <span class="song" title="{{$item->title}}">{{$item->title}}</span>

        </div>
    </a>
    <a href="#" onclick="call(event)" id="{{$item->id}}" data-id="{{$item->id}}" data-type="music" class="add-favorite plus">
        +
    </a>
</div>