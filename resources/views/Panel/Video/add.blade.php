@extends('Layout.Panel')

@section('content')

<div class="container-fluid">
   @if (!isset($post))
        @include('Includes.Panel.moviesmenu')
   @endif
    <div class="card">
        <div class="card-body">

            <form id="upload-music" method="post" @isset($post) action="{{route('Panel.EditVideo',$post)}}" @else
                action="{{route('Panel.AddVideo')}}" @endisset enctype="multipart/form-data">
                @csrf
                <div class="card-title d-flex justify-content-between">
                    <h5 class="text-center">
                        @isset($post)
                        Edit Video
                        @else
                        Add Video
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
                       @include('Includes.Panel.VideoForm')
                    
                     @include('Includes.Panel.Video')
                        
                    </div>
                    @include('Includes.Panel.VideoSideForm')
                </div>
            
              
                    <div class="col-md-12 my-2 btn--wrapper text-center">
                        <input type="submit" name="upload" id="upload" value="Upload" class="btn  btn-success" />
                    </div>
               
                <hr>
                <div class="progress col-md-12 p-0">
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
   
    @endsection