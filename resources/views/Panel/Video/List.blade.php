@extends('Layout.Panel')

@section('content')

@include('Includes.Panel.modals')

@include('Includes.Panel.moviesmenu')




<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">مدیریت ویدیو ها</h5>
            <hr>
        </div>

        <table id="example1" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    
                  <th></th>
                    <th>Title</th>
                    <th>Singer</th>
                    <th>Writer</th>
                    <th>Duration</th>
                    <th>Category</th>
                    <th>Poster</th>
                    <th></th>


                </tr>
            </thead>

            <tbody>
                @foreach($videos as $key=>$post)
                
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="#" class="text-primary">{{$post->title}}</a>
                    </td>
                    <td>
                        @foreach ($post->artists->where('role','singer') as $singer)
                        {{$singer->fullname}}
                        @endforeach
                    </td>
                    <td>
                        @foreach ($post->artists->where('role','writer') as $singer)
                        {{$singer->fullname}}
                        @endforeach
                    </td>
                    <td class="text-success">{{$post->duration}}</td>
                    <td class="text-success">{{count($post->categories) ? $post->categories->first()->name : '--' }}</td>
                    <td>
                         <img src="{{$post->image('resize')}}" style="width: 70px" />
                    </td>
                    <td>
                        <a href="{{route('Panel.EditVideo',$post)}}" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                        <a href="#" data-id="{{$post->id}}" title="حذف " data-toggle="modal" data-target="#deletePost"
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
 
    
         $('#deletePost').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#post_id').val(recipient)

    })


    //  $('.deleteposts').click(function(e){
    //         e.preventDefault()

    //         data = { array:array, _method: 'delete',_token: "{{ csrf_token() }}" };
    //         url='{{route('Panel.DeletePost')}}';
    //         request = $.post(url, data);
    //         request.done(function(res){
    //         location.reload()
    //     });
    // })
</script>

@endsection