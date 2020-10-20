@extends('Layout.Front')
@section('title',$title)
@section('main')
@include('Includes.Front.TopSlider',['sliders' => $sliders,'type'=>'photo'])

<div class="galleries-container">
    @foreach ($galleries as $gallery)
@if (count($gallery->images))

<div class="container border-photo-top  justify-content-center text-center">
    <span class="photo-top-tt">{{\Carbon\Carbon::parse($gallery->created_at)->format('F')}}<br>
        {{\Carbon\Carbon::parse($gallery->created_at)->year}}
    </span>
    <div class="row">
        <div class="col text-left">
            <h4 class="text-light">{{$gallery->title}}</h4>
        </div>
    </div>
    <div class="row">

        @foreach ($gallery->images->take(8)->chunk(4) as $key=>$chunked)
        @if (count($chunked) == 4)
        <div class="col-12 col-md-6 mb-5">
            <div class="row">
                @foreach ($chunked as $key2=>$item)
                @if ($key == 1 && $key2 === array_key_last($chunked->toArray()))
                <div class="col-3 photo-cart music-cart-wrapper scale-play-list view-event"><a
                        href="{{$gallery->url()}}"><span class="view-event-sp">View Event</span></a></div>
                @else
                <div class="col-3 photo-cart music-cart-wrapper scale-play-list "><a href="{{$gallery->url()}}"><img
                            class="photo-cart-img" src="{{asset(unserialize($item->url)['resize'])}}"></a></div>
                @endif
                @endforeach
            </div>
        </div>
        @else
        <div class="col-12 col-md-6 mb-5">
            <div class="row">
                @foreach ($chunked as $key2=>$item)
                @if ( $key2 === array_key_last($chunked->toArray()))
                <div class="col-3 photo-cart music-cart-wrapper scale-play-list view-event"><a
                        href="{{$gallery->url()}}"><span class="view-event-sp">View Event</span></a></div>
                @else
                <div class="col-3 photo-cart music-cart-wrapper scale-play-list "><a href="{{$gallery->url()}}"><img
                            class="photo-cart-img" src="{{asset(unserialize($item->url)['resize'])}}"></a></div>
                @endif
                @endforeach
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>

@endif

@endforeach
</div>

@endsection