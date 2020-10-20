<div class="container mt-page ">
    <div class="row mt-2 justify-content-center">
       @foreach ($banners as $item)
            <div class="col-12 col-md-6 ">
            <div class="music-cart-wrapper p-2">
            <a href="{{$item->url()}}">
                    <div class="music-cart">
                        <img src="{{$item->image('banner')}}" />
                        <div class="img-cover"></div>
                        <span class="tag">mp3</span>
                    </div>
                    <div class="songInfo center">
                        <span class="artist" title="{{$item->singers()}}">{{$item->singers()}}</span>
                        <span class="song" title="{{$item->title}}">{{$item->title}}</span>

                    </div>
                </a>
            </div>
        </div>
       @endforeach
       
    </div>
</div>