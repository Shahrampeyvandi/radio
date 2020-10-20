@extends('Layout.Front')

@section('main')
@include('Includes.Front.TopSlider',['sliders'=>$sliders,'type'=>'video'])
@include('Includes.Front.Alfabet')
@if (count($trending))
<div class="container mt-page ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Trending</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        @foreach ($trending as $item)
        @component('components.video-box',['video'=>$item])
        @endcomponent
        @endforeach


    </div>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-12 ">
            <dl class="tabs" data-tab="">
                <dd class="tab tab-c-con active"><a class="tab-c" href="#panel2-1">Featured</a></dd>
                <dd class="tab tab-c-con"><a class="tab-c" href="#panel2-2">Popular This Month</a></dd>
                <dd class="tab tab-c-con"><a class="tab-c" href="#panel2-3">Popular This Week</a></dd>
                <dd class="tab tab-c-con"><a class="tab-c" href="#panel2-4">Popular All Time</a></dd>
            </dl>
            <div class="row panel2" id="panel2-1">

                @foreach ($featured as $item)
                @component('components.video-box',['video'=>$item])
                @endcomponent
                @endforeach

                @if (count($featured) > 23)
                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="#">
                        <span class="view-event-sp music-cart-wrapper">View Event</span>
                    </a>
                </div>
                @endif

            </div>
            <div class="row panel2" id="panel2-2" style="display: none">

                @foreach ($this_month as $item)
                @component('components.video-box',['video'=>$item])
                @endcomponent
                @endforeach
                @if (count($this_month) > 23)

                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="{{route('S.ShowMore')}}?type=video&q=this_month">
                        <span class="view-event-sp music-cart-wrapper">View Event</span>
                    </a>
                </div>
                @endif

            </div>

            <div class="row panel2" id="panel2-3" style="display: none">
                @foreach ($this_week as $item)
                @component('components.video-box',['video'=>$item])
                @endcomponent
                @endforeach

                @if (count($this_week) > 23)

                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="{{route('S.ShowMore')}}?type=video&q=this_week">
                        <span class="view-event-sp music-cart-wrapper">View Event</span>
                    </a>
                </div>
                @endif

            </div>

            <div class="row panel2" id="panel2-4" style="display: none">
                @foreach ($all_time as $item)
                @component('components.video-box',['video'=>$item])
                @endcomponent
                @endforeach

                @if (count($all_time) > 23)
                <div class="col-6 col-md-2 photo-cart music-cart-wrapper scale-play-list view-event">
                    <a class="text-center" href="{{route('S.ShowMore')}}?type=video&q=all_time">
                        <span class="view-event-sp music-cart-wrapper">View Event</span>
                    </a>
                </div>
                @endif

            </div>


        </div>

    </div>
</div>


@endsection