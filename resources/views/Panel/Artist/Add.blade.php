@extends('Layout.Panel')

@section('content')
@if (!isset($artist))
@include('Includes.Panel.artistmenu')
@endif

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">Add Artist </h5>
                <hr />
            </div>
            <form id="add-blog" method="post" @isset($artist) action="{{route('Panel.EditArtist',$artist)}}" @else
                action="{{route('Panel.AddArtist')}}" @endisset enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for=""> Full Name : </label>
                                <input required type="text" class="form-control" name="name" id="name"
                                    value="{{$artist->fullname ?? ''}}" placeholder="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""> Role : </label>
                                <select name="role" id="role" class="form-control custom-control">
                                    <option value="Singer"
                                        {{isset($artist) && $artist->role == 'singer' ? 'selected' : ''}}>Singer
                                    </option>
                                    <option value="Writer"
                                        {{isset($artist) && $artist->role == 'writer' ? 'selected' : ''}}>Writer
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-md-5">
                                <div class="form-row">
                                    <div class="col-md-3">
                                        <label for=""> Photo: </label>
                                    </div>
                                    <div class="col-md-9">
                                        <img alt="" id="preview" width="100%" style="max-height: 400px" src="@isset($artist)
                                             {{asset(unserialize($artist->photo)['resize'])}} 
                                                @else
                                                 {{asset('assets/images/image-placeholder.jpg')}} 
                                            @endisset">
                                        <input type="file" name="poster" id="poster" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="desc">Biography: </label>
                                <textarea class="form-control" name="bio" id="bio" cols="30"
                                    rows="8">{{$artist->bio ?? ''}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">BirthDay: </label>
                                <input type="text" class="form-control  datepicker" name="birthday" id="birthday"
                                    @isset($artist)
                                    value="{{\Carbon\Carbon::parse($artist->birthday)->format('d F Y')}}" @endisset>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="custom-control custom-checkbox custom-control-inline ">
                                    <input type="checkbox" id="popular" name="popular" value="1"
                                        class="custom-control-input " @if(isset($artist) && $artist->popular == 1) checked @endif>
                                    <label class="custom-control-label" for="popular">Add To Popular Artists</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary">
                            @isset($artist)
                            ویرایش
                            @else
                            ثبت
                            @endisset
                            اطلاعات </button>
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