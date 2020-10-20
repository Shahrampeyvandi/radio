@extends('Layout.Front')
@section('title',$title)
@section('main')
@include('Includes.Front.BreadCrumb')

<div class="container">
    <div class="row">
        <div class="col-12 col-md-9 pb-3 justify-content-center text-center">
            @if (count($post->files))
            <video id="my-video" class="video-js vjs-default-skin" controls data-setup='{}'>
                @foreach ($post->files as $file)
            <source src="https://dl.radioavin.com/{{$file->url}}" type='video/mp4' label='{{$file->quality_id}}'
                    res='{{$file->quality_id}}' />
                @endforeach
            </video>
            <div class="playpause">play</div>
            @endif
        </div>
        <div class="col-12 col-md-3 music-cart-h-wrapper pl-md-0">
            <dl class="tabs" data-tab="">
                <dd class="active tab tab-b-con"><a class="tab-b" href="#related_posts">related</a></dd>
                <dd class="tab tab-b-con"><a class="tab-b" href="#this_week">lyrics</a></dd>
            </dl>
            <div class="panel1 play-list" id="related_posts">
                @foreach ($related_posts as $item)
               @component('components.list-view',['item'=>$item])
                   
               @endcomponent
                @endforeach
            </div>
            <div class="panel1" id="this_week" style="display: none">
                <span class="lyrics-span">
                    {!! $post->description !!}
                </span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('frontend/assets/js/videojs.js')}}"></script>
<script>
    var options = {};
    videojs('my-video').videoJsResolutionSwitcher()
</script>
@endsection

@section('css')
<link href="{{asset('frontend/assets/css/videojs.css')}}" rel="stylesheet" />
@endsection