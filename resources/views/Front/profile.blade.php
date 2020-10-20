@extends('Layout.Front')

@section('main')
<div class="container mt-page ">
    <div class="row text-center justify-content-center">
        <div class="col-10 col-md-6">
            <div class="formContainer1 forms">
                <div class="panels">
                    <div class="leftPanel emptyState">
                        <i class="fa fa-user "></i>
                    </div>
                    <div class="rightPanel">
                        <div class="titleContainer" style="margin-bottom: 20px">
                            <h3 class="title dark">Edit Profile</h3>
                            @if (count($errors))
                            <h6 class="text-danger">
                                {{ $errors->first() }}
                            </h6>
                            @endif
                        </div>
                        <div id="">
                            <div id="">
                                <form id="profile" class="parsley-validate" action="{{route('Profile')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="email" id="email" value="{{$user->email ?? ''}}"
                                        placeholder="*Email" readonly>
                                    <input type="text" name="mobile" id="mobile" value="{{$user->mobile ?? ''}}"
                                        placeholder="Mobile">
                                    <input type="text" name="password" id="password" placeholder="New Password">
                                    <input type="text" name="cpassword" id="cpassword" placeholder="Confirm Password">
                                    <div class="photo text-left">
                                        @if ($user->avatar)
                                        <img src="{{asset($user->avatar)}}" alt="Default profile thumb"
                                            style="width: 100px">
                                        @else
                                        <img src="https://d1eqqkloubk286.cloudfront.net/static/profiles/default-profile-thumb.jpg"
                                            alt="Default profile thumb" style="width: 100px">
                                        @endif
                                        <input type="file" name="photo" id="photo" class="mt-2">
                                    </div>
                                    <div style="margin-top: 10px">
                                        <button type="submit" class="submit-button">Confirm</button>
                                        <div class="alert-box alert form_error twelve columns" style="display: none">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection