@extends('Layout.Panel')

@section('content')
 <!-- modals -->

 @component('components.modal',['name'=>'user','url'=>'panel/user/delete','method'=>'delete'])
@endcomponent
<div class="modal fade" id="add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form id="add-member" action="{{route('Panel.AddUser')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">افزودن</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        
                       
                      <div class="form-group col-md-6">
                         <label for=""> Email: <span class="text-danger">*</span> </label>
                         <input type="text" class="form-control" name="email" id="email" value=""
                             >
                     </div>
                        <div class="form-group col-md-6">
                            <label for="">  Mobile: </label>
                            <input type="text" class="form-control" name="mobile" id="mobile" value=""
                                >
                        </div>
                         <div class="form-group col-md-6">
                            <label for=""> <span class="text-danger">*</span>  Password</label>
                            <input type="text" class="form-control" name="password" id="password" value=""
                                >
                        </div>
                         <div class="form-group col-md-6">
                            <label for=""> <span class="text-danger">*</span>  Confirm Password</label>
                            <input type="text" class="form-control" name="cpassword" id="cpassword" value=""
                                >
                        </div>
                        <div class="form-group col-md-12">
                                <div class="custom-control custom-checkbox custom-control-inline">
                                    <input type="checkbox" id="sendsms" name="sendsms" value="1"
                                        class="custom-control-input" >
                                    <label class="custom-control-label" for="sendsms">
                                        Send Message To User</label>
                                </div>

                            </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class=" btn btn-success text-white">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">اخطار</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                موارد علامت زده شده حذف شوند؟
            </div>
            <div class="modal-footer">
                <form action="" method="post">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="video_id" id="video_id" value="">
                    <a href="#" class="deleteposts btn btn-danger text-white">حذف! </a>
                </form>
            </div>
        </div>
    </div>
</div>

      <div
        class="modal fade bd-example-modal-lg-edit"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content edit-modal-user"></div>
        </div>
      </div>

      <!-- end modals -->

      <div class="container-fluid">
        <div class="card">
          <div class="container_icon card-body d-flex justify-content-end">
        <div class="delete-edit" style="display:none;">
            <a href="#" title="حذف " data-toggle="modal" data-target="#exampleModal" class="order-delete   m-2">
                <span class="__icon bg-danger">
                    <i class="fa fa-trash"></i>
                </span>
            </a>
        </div>
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#add-user">افزودن <i class="fas fa-plus"></i></a>
    </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h5 class="text-center">مدیریت کاربران</h5>
              <hr />
            </div>
            <div style="overflow-x: auto;">
              <table id="example1" class="table table-striped table-bordered">
                <thead>
                  <tr>
               
                    <th>ردیف</th>
                   <th>ایمیل</th>
                    <th>شماره موبایل</th>
                    <th>پروفایل عکس</th>
                    <th>عملیات</th>
                  </tr>
                </thead>
                <tbody class="tbody">
                  @foreach ($users as $key=>$user)
                  <tr>
                    
                    
                    <td>{{$key+1}}</td>
                 
                  <td>{{$user->email}}</td>
                    <td>{{$user->mobile}}</td>
                    <td>
                      @if ($user->avatar !== '' &&
                      $user->avatar !== null ) <img width="75px"
                      class="img-fluid " src="
                      {{asset("uploads/brokers/$user->avatar")}} " />
                      @else <img width="75px" class="img-fluid " src="
                      {{asset("assets/images/avatar.png")}} " /> @endif
                    </td>
                    <td>
                        <a href="{{route('Panel.EditUser',$user)}}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                        <a href="#" data-id="{{$user->id}}" title="حذف " data-toggle="modal" data-target="#deleteuser"
                            class="btn btn-sm btn-danger   m-2">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('js')
<script>
     $('#deleteuser').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#user_id').val(recipient)
    })
</script>
@endsection