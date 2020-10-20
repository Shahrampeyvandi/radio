@extends('Layout.Panel')

@section('content')

<div class="container-fluid">
    @if (!isset($post))
    @include('Includes.Panel.seriesmenu')
    @endif
    <div class="card">
        <div class="card-body">
            <form id="upload-music" method="post" @isset($post) action="{{route('Panel.EditMusic',$post)}}" @else
                action="{{route('Panel.AddMusic')}}" @endisset enctype="multipart/form-data">
                @csrf
                <div class="card-title d-flex justify-content-between">
                    <h5 class="text-center">
                        @isset($post)
                        Edit Music
                        @else
                        Add Music
                        @endisset
                    </h5>
                    <button type="submit" class="btn btn-primary">
                        @isset($post)
                        ویرایش
                        @else
                        ذخیره
                        @endisset
                    </button>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="custom-control custom-checkbox custom-control-inline ">
                                    <input type="checkbox" id="podcast" name="podcast" value="1"
                                        class="custom-control-input " @if (isset($post)) @endif>
                                    <label class="custom-control-label" for="podcast">Podcast</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""> PlayList: </label>
                                <select name="playlists[]" class="js-example-basic-single" multiple dir="rtl">
                                    @foreach ($playlists as $playlist)
                                    <option value="{{$playlist->id}}"
                                        {{isset($post) && $post->playlists()->pluck('id')->contains($playlist->id) ? 'selected' : ''}}>
                                        {{$playlist->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @include('Includes.Panel.MusicForm')
                        @include('Includes.Panel.Music')
                    </div>
                    @include('Includes.Panel.MusicSideForm')
                </div>

                <div class="row">
                    <div class="col-md-12 my-2 btn--wrapper text-center">
                        <input type="submit" name="upload" id="upload" value="Upload" class="btn  btn-success" />
                    </div>
                </div>
                <hr>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                        style="width: 0%">
                        0%
                    </div>
                </div>
            </form>
            <hr>
        </div>
    </div>

    @endsection
    @section('css')
    <link rel="stylesheet" href="{{asset('assets/vendors/datepicker/bootstrap-datepicker.min.css')}}">
    @endsection
    @section('js')

    <script src="{{asset('assets/vendors/datepicker/bootstrap-datepicker.min.js')}}"></script>

    <script>
        //  $.validator.addMethod('filesize', function (value, element, param) {
        // return this.optional(element) || (element.files[0].size <= param)
        //  }, 'سایز تصویر نمی تواند بیشتر از دو مگابایت باشد');
        // $.validator.addMethod(
        // "regex",
        // function(value, element, regexp) {
        //     return this.optional(element) || regexp.test(value);
        // },
        // "Please check your input."
        // );
    
    </script>
    @endsection