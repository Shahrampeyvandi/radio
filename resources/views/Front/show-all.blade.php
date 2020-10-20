@extends('Layout.Front')
@section('title',$title)

@section('main')
<div class="showall-container">
    @if (count($posts))
<div class="container ">

    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title mb-2">{{$page_title}}</h2>
            </div>
        </div>
        <div class="col text-right">
        </div>
    </div>
    <div class="row">
        @foreach ($posts as $item)
        
             @component('components.music-box',['item' => $item])
                @endcomponent
        
        @endforeach


    </div>
</div>
@endif

</div>

@endsection