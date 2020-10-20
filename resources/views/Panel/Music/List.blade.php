@extends('Layout.Panel')

@section('content')
@component('components.modal',['name'=>'post','url'=>'panel/post/delete','method'=>'delete'])
@endcomponent

@include('Includes.Panel.seriesmenu')

<div class="card filtering" >
<form action="{{route('FilterPosts')}}" method="post">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="col-form-label">Category: </label>
                    <select id=""  name="cat" class="js-example-basic-single">
                        <option value="">choose item</option>
                        @foreach (\App\Category::all() as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="recipient-name" class="col-form-label">Singer: </label>
                    <select id="filtering"  name="singer" class="js-example-basic-single">
                            <option value="">choose item</option>
                        @foreach (\App\Artist::where('role','singer')->get() as $item)
                        <option value="{{$item->id}}">{{$item->fullname}}</option>
                        @endforeach

                    </select>
                </div>
                
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="card">
    <div class="card-body">
        <div class="card-title">
            <h5 class="text-center">مدیریت آهنگ ها</h5>
            <hr>
        </div>
        <table id="music-table" class="table table-striped table-bordered w-100">
            <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Singer</th>
                    <th>Writer</th>
                    <th>Album</th>
                    <th>Duration</th>
                    <th>Category</th>
                    <th>Poster</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($musics as $key=>$post)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="#" class="text-primary">{{$post->title}}</a>
                    </td>
                    <td>
                        {{$post->singers()}}
                    </td>
                    <td>
                       --
                    </td>
                    <td>
                        @if (count($post->albums))
                        {{$post->albums->first()->name}}
                        @endif
                    </td>
                    <td class="text-success">{{$post->duration}}</td>
                    <td class="text-success">{{count($post->categories) ? $post->categories->first()->name : '--' }}
                    </td>
                    <td>
                        <img src="{{$post->image('resize')}}" style="width: 70px" />
                    </td>
                    <td>
                        <a href="{{route('Panel.EditMusic',$post)}}" class="btn btn-sm btn-info">ویرایش</a>
                        <a href="#" data-id="{{$post->id}}" title="حذف " data-toggle="modal" data-target="#deletepost"
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
@endsection
@section('css')
@endsection
@section('js')
<script>
    $('#deletepost').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var recipient = button.data('id')
            $('#post_id').val(recipient)

    })

 

</script>

@endsection