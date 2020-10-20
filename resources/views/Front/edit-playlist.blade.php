@extends('Layout.Front')

@section('main')
<div class="container mt-page ">
    <div class="row text-center justify-content-center">
        <div id="playlist" class="col-md-12">
            <div class="panelsContainer">
                <div class="mainPanel">
                    <div class="panelInner">
                        <h2 class="title text-white">{{$playlist->name}}</h2>
                        <div id="actions" class="playlist_container actions flexContainer center">
                            <a class="button textButton light" href="#" id="rename_link" data-id="1"
                                onclick="editPlaylistName(event,'{{$playlist->id}}')">
                                <i class="fas fa-pen"></i>
                                Rename
                            </a>
                            <a id="delete_link" class="button textButton light" href="#"
                                onclick="deletePlaylist(event,'{{$playlist->id}}','{{$playlist->name}}')">
                                <i class="fa fa-trash"></i>
                                Delete
                            </a>
                            <a href="{{$playlist->playurl()}}" class="play_all button textButton light">

                                <i class="fa fa-play"></i>
                                Play
                            </a>
                            <a href="/mp3s/playlist_start?id=efbe47c297b9&amp;shuffle=1"
                                class="shuffle_all button textButton light">
                                <i class="fas fa-random"></i>
                                Shuffle
                            </a>
                        </div>
                        <div class="list-tracks">
                            <ul class="listView">
                                @foreach ($playlist->tracks as $key=>$track)
                                <li>
                                    <span class="track ui-sortable-handle">{{($key++)}}.</span>
                                    <span style="margin-right:auto;" class="ui-sortable-handle">
                                        <a href="">
                                            <img border="0" alt="" src="{{$track->image('resize')}}">
                                            <div class="songInfo">
                                                <span class="artist ui-sortable-handle"
                                                    title="{{$track->title}}">{{$track->title}}</span>
                                                <span class="song ui-sortable-handle"
                                                    title="{{$track->singers()}}">{{$track->singers()}}</span>
                                            </div>
                                        </a>
                                    </span>
                                    <span class="ui-sortable-handle">
                                        <form action="{{route('UserPlaylist.Delete')}}" method="post">
                                            @csrf
                                        <input type="hidden" name="playlist_id" value="{{$playlist->id}}" >
                                        <input type="hidden" name="id" value="{{$track->id}}" >
                                            <button class="delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </span>
                                </li>

                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
          

          
           
        </div>
    </div>
</div>
@endsection