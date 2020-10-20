@extends('Layout.Front')
@section('title',$title)

@section('main')
<div class="playlist-container">
    @if (count($featured))
<div class="container mt-page ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Featured Playlists</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        @foreach ($featured as $item)
        <div class="col-6 col-md-2">
            @component('components.playlist-item',['playlist'=>$item,'songs'=>count($item->tracks)])
            @endcomponent
        </div>
        @endforeach


    </div>
</div>
@endif
@if (count($browse))
<div class="container">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Browse</h2>
            </div>
        </div>
        <div class="col text-right">

        </div>
    </div>
    <div class="row">
        @foreach ($browse as $item)
        <div class="col-6 col-md-2">
            @component('components.playlist-item',['playlist'=>$item,'songs'=>count($item->tracks)])
            @endcomponent
        </div>
        @endforeach
    </div>
</div>
@endif

@if (isset($my_playlists) && count($my_playlists))
<div class="container">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">My PlayLists</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
       @foreach ($my_playlists as $item)
            <div class="col-6 col-md-2">
            @component('components.playlist-item',['playlist'=>$item,'songs'=>count($item->tracks)])
            @endcomponent
        </div>
       @endforeach
    </div>
</div>
@endif
</div>

@endsection