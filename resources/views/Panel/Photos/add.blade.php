@extends('Layout.Panel')

@section('content')

@include('Includes.Panel.Gallerymenu')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center">Add Photos Gallery</h5>
                <hr />
            </div>
            <form id="upload-file" method="post" action="{{route('Panel.AddGallery')}}" enctype="multipart/form-data">
                @csrf
                @isset($post)
                @method('PUT')
                <input type="hidden" name="post_id" id="post_id" value="{{$post->id}}">
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for=""> Title: </label>
                                <input type="text" class="form-control" name="title" id="title" required
                                    value="{{$post->name ?? ''}}" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span style="cursor: pointer;" href="">
                                    Poster: </span>

                                <div class="row">
                                    <div class=" col-md-6 image-box">
                                        <div class="form-group">
                                            <input required type="file" name="poster" class="dropify"
                                                data-max-file-size="1000K" data-allowed-file-extensions="png jpg jpeg"
                                                data-default-file="" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <label for="desc">Images: </label>
                        @isset($post)
                        <div class="row">
                            @foreach ($post->images as $image)
                            <div class=" col-md-3">
                                <a style="cursor: pointer;color:red" onclick="removeImage(event,{{$image->id}})"><i
                                        class="fas fa-trash"></i></a>
                                <img width="100%" src="{{asset($image->url)}}" alt="">
                            </div>
                            @endforeach
                        </div>
                        @endisset
                        <span style="cursor: pointer;" href="" onclick="getClone(this)"><i class="fa fa-plus"></i>
                            add image </span>

                        <div class="row">
                            <div class=" col-md-3 image-box">
                                <div class="form-group">
                                    <input required type="file" name="images[]" class="dropify"
                                        data-max-file-size="300K" data-allowed-file-extensions="png jpg jpeg"
                                        data-default-file="" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary"> Save </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    function removeImage (event,id) {
            event.preventDefault()
            var target =$(event.target)
            data = { id:id, _method: 'delete',_token: "{{ csrf_token() }}" };
            url='{{route('Panel.DeleteImage')}}';
            request = $.post(url, data);
            request.done(function(res){
            target.parents('.col-md-3').remove()
        });
            }
              
               
              

           
</script>
@endsection