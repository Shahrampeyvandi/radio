@extends('Layout.Panel')

@section('content')

@include('Includes.Panel.modals')

@include('Includes.Panel.playlistmenu')
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">Play List </h5>
            <hr>
        </div>
        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    
                    <th></th>
                    <th> Name </th>
                    <th>Songs</th>
                    <th>Created At</th>
                    <th>Poster</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($playlists as $key=>$playlist)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="#" class="text-primary">{{$playlist->name}}</a>
                    </td>
                    <td>
                        {{count($playlist->tracks)}}
                    </td>
                    <td>
                        {{\Carbon\Carbon::parse($playlist->created_at)->format('d F Y')}}
                    </td>
                    <td>
                        <img src="{{asset($playlist->image)}}" alt="" width="100px">
                    </td>
                    <td class="text-center"> 
                        <a href="{{route('Panel.EditPlayList',$playlist)}}" class="btn btn-sm btn-info">Edit</a>
                        <a href="#" data-id="{{$playlist->id}}" title="حذف " data-toggle="modal" data-target="#deletePlaylist"
                            class="btn btn-sm btn-danger   m-2">
                            <i class="fa fa-trash"></i>
                        </a>
                         <a href="#"  title=" "
                         onclick="changeFeaturedPlaylist(event,'{{$playlist->id}}','{{route('Panel.ChangeFeatured')}}')"
                            class="btn btn-sm {{$playlist->featured == 1 ? 'btn-success ' : 'btn-danger '}}   m-2">
                           Featured
                        </a>
                    </td>
                    @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('css')

@endsection

@section('js')
<script>
  $('#deletePlaylist').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#id').val(recipient)

    })
</script>

@endsection