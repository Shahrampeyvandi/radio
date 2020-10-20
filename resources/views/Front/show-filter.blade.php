@extends('Layout.Front')

@section('main')
<section class="mt-10 mh-80">

    @include('Includes.Front.Alfabet')


    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <a href="{{url()->previous()}}" style="    color: #ffffff7a;
">
                        <i class="fa fa-angle-left fa-2x"> </i>
                    </a>
                    <span style="color: white;font-size: 20px">
                        {{$q}}
                    </span>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($singers as $item)
            <div class="col-sm-6 col-md-2 filter-item">
                <a href="{{$item->url()}}">
                    <img src="{{$item->image('resize')}}" alt="{{$item->fullname}}">
                    <div class="songInfo">
                        <span class="artist" title="{{$item->fullname}}">{{$item->fullname}}</span>
                    </div>
                </a>
            </div>
            @endforeach

        </div>

    </div>
</section>
@endsection