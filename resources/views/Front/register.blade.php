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
                            <h3 class="title dark">Register To RadioAvin</h3>
                            @if (count($errors))
                            <h6 class="text-danger">
                                {{ $errors->first() }}
                            </h6>
                            @endif
                        </div>
                        <div id="">
                            <div id="">
                                <form id="register" class="parsley-validate" action="{{route('S.Register')}}" method="post">
                                    @csrf
                                    <input type="text" name="email" id="email" placeholder="*Email">
                                    <input type="text" name="mobile" id="mobile" placeholder="Mobile">
                                    <input type="text" name="password" id="password" placeholder="*Password">
                                    <input type="text" name="cpassword" id="cpassword" placeholder="*Confirm Password">
                                    <div style="margin-top: 10px">
                                        <button type="submit" class="submit-button">Register</button>
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