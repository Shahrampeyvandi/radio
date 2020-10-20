@extends('Layout.Front')
@section('title',$title)
@section('main')

<div class="mt-page">
    <div id="breadcrumbs_container" class="container">
        <div class="row">
            <div class="col">
                <ul class="breadcrumbs">
                    <li><a href="{{route('MainUrl')}}"><i class="fa fa-home"></i></a></li>
                    <li><a href="#">
                            Photos
                        </a></li>
                    <li><a href="#">
                            {{$gallery->title}}
                        </a></li>
                    <li class="current"><a href="#">{{\Carbon\Carbon::parse($gallery->created_at)->format('F')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container ">
    <div class="min-h-15">
        <div class="row photos-wrapper image-set">
            @foreach ($gallery->images as $key=>$item)
            <div class="col-4 col-md-1 photo-cart music-cart-wrapper scale-play-list ">
            <a href="{{asset(unserialize($item->url)['org'])}}" data-lightbox="roadtrip">
                    <img
                        class="photo-cart-img" src="{{asset(unserialize($item->url)['resize'])}}"></a></div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('frontend/assets/js/lightbox.js')}}"></script>
<script>
    $('.image-set a').lightBox()
</script>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('frontend/assets/css/lightbox/lightbox.css')}}">
@endsection