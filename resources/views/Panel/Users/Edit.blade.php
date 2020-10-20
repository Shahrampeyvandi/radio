@extends('Layout.Panel')

@section('content')
<!-- modals -->

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form id="add-member" action="{{route('Panel.EditUser',$user->id)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for=""> Email: <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""> Mobile: </label>
                            <input type="text" class="form-control" name="mobile" id="mobile" value="{{$user->mobile}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""> <span class="text-danger">*</span> Password</label>
                            <input type="text" class="form-control" name="password" id="password" value="{{$user->password}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for=""> <span class="text-danger">*</span> Confirm Password</label>
                                <input type="text" class="form-control" name="cpassword" id="cpassword" value="{{$user->password}}">
                            </div>
                            <div class="form-group col-md-12">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="sendsms" name="sendsms" value="1"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="sendsms">
                                        Send Message To User</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class=" btn btn-success text-white">Edit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

</div>

@endsection