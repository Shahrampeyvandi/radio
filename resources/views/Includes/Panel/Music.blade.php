@if(isset($post) && count($post->files))
@if ($post->type == 'video')
<div class="position-relative file-wrapper">
    <a href="#" onclick="deleteFile(event,'{{$post->files->first()->id}}','{{route('Ajax.DeleteFile')}}')"
        class="d-block mr-2 mb-3 delete-file"><i class="fa fa-times"></i> </a>
    <video width="320" height="240" controls>
        <source src="{{$post->file_url()}}" type="video/mp4">
    </video>
</div>
@else
<div class="position-relative file-wrapper">
    <a href="#" onclick="deleteFile(event,'{{$post->files->first()->id}}','{{route('Ajax.DeleteFile')}}')"
        class="d-block mr-2 mb-3 delete-file"><i class="fa fa-times"></i> </a>
    <audio controls>
        <source src="horse.ogg" type="audio/ogg">
        <source src="{{$post->file_url()}}" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
</div>
@endif
<div class="form-group col-md-6">
    <label for=""> Upload File: </label>
    <input  type="file" name="file" id="" class="form-control" />
</div>
@else
<div class="form-group col-md-6">
    <label for=""> Upload File: </label>
    <input  type="file" name="file" id="file" class="form-control" required/>
</div>

@endif