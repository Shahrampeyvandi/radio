@extends('Layout.Front')

@section('main')
@include('Includes.Front.TopSlider',['sliders' => $sliders,'type'=>'music'])
@include('Includes.Front.Alfabet')
<div class="container">
    <div class="row mb-2">
        <div class="col-12 col-md-9">
            <dl class="tabs" data-tab="">
                <dd class="tab tab-c-con active"><a class="tab-c" href="#panel2-1">Trending Now</a></dd>
                <dd class="tab tab-c-con"><a class="tab-c" href="#panel2-2">Featured Songs</a></dd>
            </dl>
            <div class="row panel2" id="panel2-1">
                @if (count($trending))
                @foreach ($trending as $item)
                @component('components.music-box',['item' => $item])
                @endcomponent
                @endforeach
                @if (count($trending) > 23)
                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="{{route('S.ShowMore')}}?type=music&q=trending">
                        <span class="view-event-sp music-cart-wrapper">View More</span>
                    </a>
                </div>
                @endif
                @endif

            </div>

            <div class="row panel2" id="panel2-2" style="display: none">
                @if (count($featured))
                @foreach ($featured as $item)
                @component('components.music-box',['item' => $item])
                @endcomponent
                @endforeach
                @if (count($featured) > 23)
                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="{{route('S.ShowMore')}}?type=music&q=featured">
                        <span class="view-event-sp music-cart-wrapper">View More</span>
                    </a>
                </div>
                @endif
                @endif

            </div>


        </div>
        <div class="col-12 col-md-3 music-cart-h-wrapper pl-md-0">
            <dl class="tabs" data-tab="">
                <dd class="active tab tab-b-con"><a class="tab-b" href="#this_month">This Month</a></dd>
                <dd class="tab tab-b-con"><a class="tab-b" href="#this_week">This Week</a></dd>
                <dd class="tab tab-b-con"><a class="tab-b" href="#all_time">All time</a></dd>
            </dl>
            <div class="panel1" id="this_month">
                @if (count($this_month))
                @foreach ($this_month as $item)
                @component('components.list-view',['item'=>$item])
                @endcomponent
                @endforeach
                <div class="music-cart-h view-event ">
                    <a class="text-center" href="{{route('S.ShowMore')}}?type=music&q=this_month">
                        <span class="view-event-sp music-cart-wrapper">View More</span>
                    </a>
                </div>
                @endif
            </div>
            <div class="panel1" id="this_week" style="display: none">
                @if (count($this_month))
                @foreach ($this_week as $item)
                @component('components.list-view',['item'=>$item])
                @endcomponent
                @endforeach
                @endif

                <div class="music-cart-h view-event ">
                    <a class="text-center" href="{{route('S.ShowMore')}}?type=music&q=this_week">
                        <span class="view-event-sp music-cart-wrapper">View More</span>
                    </a>
                </div>
            </div>
            <div class="panel1" id="all_time" style="display: none">
                @if (count($this_month))
                @foreach ($all_time as $item)
                @component('components.list-view',['item'=>$item])
                @endcomponent
                @endforeach
                @endif

                <div class="music-cart-h view-event ">
                    <a class="text-center" href="{{route('S.ShowMore')}}?type=music&q=all_time">
                        <span class="view-event-sp music-cart-wrapper">View More</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@if (count($albums))
<div class="container mt-5 mb-5">
    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">New Albums</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        @foreach ($albums as $album)
            @component('components.album-box',['album'=>$album])
        @endcomponent
        @endforeach
    </div>
</div>
@endif


@endsection