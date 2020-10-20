@extends('Layout.Panel')

@section('content')

<div class="modal fade" id="deleteAlbum" tabindex="-1" role="dialog" aria-labelledby="deleteAlbumLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAlbumLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @isset($title)
                {{$title}}
                @else
                برای حذف این مورد مطمئن هستید
                @endisset
            </div>
            <div class="modal-footer">
                <form action="{{route('Panel.DeleteAlbum')}}" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="id" id="album_id" value="">
                    <button href="#" type="submit" class=" btn btn-danger text-white">حذف! </button>
                </form>
            </div>
        </div>
    </div>
</div>

@include('Includes.Panel.albummenu')
<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center"> Albums</h5>
            <hr>
        </div>
        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th></th>
                    <th> Name </th>
                    <th> Singer(s) </th>
                    <th>Songs</th>
                    <th>Created At</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($albums as $key=>$album)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="#" class="text-primary">{{$album->name}}</a>
                    </td>
                    <td>
                        @foreach ($album->singers as $singer)
                        <a href="{{$singer->url()}}" class="text-primary">{{$singer->fullname}}</a>
                        @endforeach
                    </td>
                    <td>
                        {{count($album->posts)}}
                    </td>

                    <td>
                        {{\Carbon\Carbon::parse($album->created_at)->format('d F Y')}}
                    </td>
                    <td>
                        <a href="{{route('Panel.EditAlbum',$album)}}" class="btn btn-sm btn-info">Edit</a>
                        <a href="#" data-id="{{$album->id}}" title="حذف " data-toggle="modal" data-target="#deleteAlbum"
                            class="btn btn-sm btn-danger   m-2">

                            <i class="fa fa-trash"></i>
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
    $('#deleteAlbum').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#album_id').val(recipient)

    })
</script>

@endsection