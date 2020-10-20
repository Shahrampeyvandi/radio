@extends('Layout.Panel')

@section('content')
@if (!isset($album))
@include('Includes.Panel.albummenu')
@endif

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">Add Album </h5>
                <hr />
            </div>
            <form id="add-blog" method="post" @isset($album) action="{{route('Panel.EditAlbum',$album)}}" @else
                action="{{route('Panel.AddAlbum')}}" @endisset enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for=""><span class="text-danger">*</span> Name : </label>
                                <input required type="text" class="form-control" name="name" id="name"
                                    value="{{$album->name ?? ''}}" placeholder="" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for=""> Singer: </label>
                                <select name="singers[]" class="js-example-basic-single" multiple dir="rtl" required>
                                    @foreach (\App\Artist::whereRole('singer')->orderBy('fullname','asc')->get() as
                                    $singer)
                                    <option value="{{$singer->id}}"
                                        {{isset($album) && $album->singers->pluck('id')->contains($singer->id) ? 'selected' : ''}}>
                                        {{$singer->fullname}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-5">
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""><span class="text-danger">*</span> Poster: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px" src="@isset($album)
                                             {{asset($album->image)}} 
                                                @else
                                                 {{asset('assets/images/640x360.png')}} 
                                            @endisset">
                                        <input type="file" name="poster" id="poster" @if (!isset($album)) required
                                            @endif />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">Information: </label>
                                <textarea class="form-control" name="bio" id="bio" cols="30"
                                    rows="8">{{$album->information ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""><span class="text-danger">*</span> Add Songs: </label>
                                <select name="songs[]" class="js-example-basic-single" multiple dir="rtl">
                                    @foreach (\App\Post::where('type','music')->get() as $song)
                                    <option value="{{$song->id}}"
                                        {{isset($album) && $album->posts()->pluck('id')->contains($song->id) ? 'selected' : ''}}>
                                        {{$song->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            @isset($album)
                            Edit Album
                            @else
                            Add Album
                            @endisset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('assets/vendors/datepicker/bootstrap-datepicker.min.css')}}">
@endsection
@section('js')
<script src="{{asset('assets/vendors/datepicker/bootstrap-datepicker.min.js')}}"></script>


@endsection