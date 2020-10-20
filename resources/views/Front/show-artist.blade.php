@extends('Layout.Front')
@section('title',$title)

@section('main')


<div class="container">
    <div class="row">
        <div class="poster-wrapper ">
            <img class="artist-poster" src="{{asset(unserialize($artist->photo)['banner'])}}" alt="">
            <div class="poster-overlay"></div>
        </div>

    </div>
</div>


@if (count($mp3s))
<div class="container mt-page ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">MP3s</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        @foreach ($mp3s as $post)
        @component('components.music-box',['item' => $post])
        @endcomponent
        @endforeach


    </div>
</div>
@endif

@if (isset($albums) && count($albums))
<div class="container mt-page ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Albums</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        @foreach ($albums as $album)
        @component('components.album-box',['album' => $album])
        @endcomponent
        @endforeach


    </div>
</div>
@endif


@if (isset($videos) && count($videos))
<div class="container mt-page ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Videos</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        @foreach ($videos as $post)
        @component('components.music-box',['item' => $post])
        @endcomponent
        @endforeach


    </div>
</div>
@endif

@endsection