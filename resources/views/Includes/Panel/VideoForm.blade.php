<div class="row">
    <div class="form-group col-md-12">
        <label for="">Title: </label>
        <input type="text" class="form-control" name="title" id="title" value="{{$post->title ?? ''}}">
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label for="">Released: </label>
        <input type="text" class="form-control  datepicker" name="released" id="released" @isset($post)
            value="{{\Carbon\Carbon::parse($post->released)->format('d F Y')}}" @endisset>
    </div>
</div>

<div class="row my-3">
    <div class="form-group col-md-12">
        <div class="form-row">
            <div class="col-md-3">
                <label for=""> Poster: </label>
            </div>
            <div class="col-md-9">
                <img alt="" id="preview" width="100%" style="max-height: 400px" src="@isset($post)
                                             {{asset($post->poster)}} 
                                                @else
                                                 {{asset('assets/images/640x360.png')}} 
                                            @endisset">
                <input type="file" name="poster" id="poster" />
            </div>
        </div>
    </div>
</div>