<div class="col-md-4">
    {{-- singer--}}


    <div class="row">
        <div class="form-group col-md-12">
            <label for=""> Singer: </label>
            <select name="singers[]" class="js-example-basic-single" multiple dir="rtl" required>
                @foreach ($singers as $singer)
                <option value="{{$singer->id}}"
                    {{isset($post) && $post->artists->pluck('id')->contains($singer->id) ? 'selected' : ''}}>
                    {{$singer->fullname}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="row">
        <div class="form-group col-md-12">
            <label for=""> Writer: </label>
            <select name="writers[]" class="js-example-basic-single" multiple dir="rtl">
                @foreach ($writers as $writer)
                <option value="{{$writer->id}}"
                    {{isset($post) && $post->artists->pluck('id')->contains($writer->id) ? 'selected' : ''}}>
                    {{$writer->fullname}}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{-- end categorys --}}
    <h6 class="">Album: </h6>
    <div class="album row mb-3">
        <div class="col-md-12">

            <select name="albums[]" class="js-example-basic-single" multiple dir="rtl">
                @foreach ($albums as $album)
                <option value="{{$album->id}}"
                    {{isset($post) && $post->albums->pluck('id')->contains($album->id) ? 'selected' : ''}}>
                    {{$album->name}}</option>
                @endforeach
            </select>
        </div>
    </div>


    {{-- tags --}}
    {{-- <h6 class="">Tags: </h6>
    <div class="cat row">
        <div class="col-md-12">
            <div class="d-flex">
                <input type="text" class="form-control mb-2" name="" id="tag" placeholder="name">
            </div>
            <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addTag(event)">add</a>
            <div class="tag-wrapper  card pr-2" style=" min-height:50px;max-height: 200px;overflow-y: scroll;">
                @foreach (\App\Tag::all() as $key=>$item)
                <div class="custom-control custom-checkbox custom-control-inline ">
                     <a href="#"  class="delete-tag" onclick="deleteTag(event,'{{$item->id}}','{{route('DeleteTag')}}')"><i
        class="fa fa-times"></i>
    </a>
    <input type="checkbox" id="tag-{{$key+1}}" name="tags[]" value="{{$item->name}}" class="custom-control-input stag"
        @if (isset($post)) {{$post->tags->pluck('id')->contains($item->id) ? 'checked' : ''}} @endif>
    <label class="custom-control-label" for="tag-{{$key+1}}">{{$item->name}}</label>
</div>
@endforeach
</div>
</div>
</div> --}}
{{-- end tags --}}

{{-- Lyrics --}}
<h6 class="">Categories: </h6>
<div class="cat row">
    <div class="col-md-12">
        <div class="d-flex">
            <input type="text" class="form-control mb-2" name="" id="category" placeholder="name">
        </div>
        <a href="#" class="btn btn-sm btn-primary mb-3"
            onclick="addCategory(event,'{{route('Panel.AddCatAjax')}}')">add</a>
        <div class="cat-wrapper  card pr-2" style=" min-height:50px;max-height: 200px;overflow-y: scroll;">
             <div class="custom-control custom-radio custom-control-inline ">
            <input type="radio" id="catego" name="category" value=""
                    class="custom-control-input" 
                    checked>
                <label class="custom-control-label" for="catego">No Category</label>
             </div>
            @foreach (\App\Category::all() as $key=>$item)
            <div class="custom-control custom-radio custom-control-inline ">
               @if($item->id !== 2 && $item->id !== 3) 
                <a href="#" class="delete-tag"
                    onclick="deleteCategory(event,'{{$item->id}}','{{route('DeleteCategory')}}')"><i
                        class="fa fa-times"></i>
                </a>
               @endif
                <input type="radio" id="category-{{$key+1}}" name="category" value="{{$item->name}}"
                    class="custom-control-input scategory" @if (isset($post))
                    {{$post->categories->pluck('id')->contains($item->id) ? 'checked' : ''}} @endif>
                <label class="custom-control-label" for="category-{{$key+1}}">{{$item->name}}</label>
            </div>
            @endforeach
        </div>
    </div>
</div>
{{-- end categorys --}}


{{-- arrangements --}}
<h6 class="">Arrangements: </h6>
<div class="cat row">
    <div class="col-md-12">
        <div class="d-flex">
            <input type="text" class="form-control mb-2" name="" id="arrangement" placeholder="name">
        </div>
        <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addArrangement(event)">add</a>
        <div class="arrangement-wrapper  card pr-2" style=" min-height:50px;max-height: 200px;overflow-y: scroll;">
            @foreach (\App\Arrangement::all() as $key=>$item)
            <div class="custom-control custom-checkbox custom-control-inline ">
                <a href="#" class="delete-tag"
                    onclick="deleteArrangement(event,'{{$item->id}}','{{route('DeleteArrangement')}}')"><i
                        class="fa fa-times"></i>
                </a>
                <input type="checkbox" id="arrangement-{{$key+1}}" name="arrangements[]" value="{{$item->name}}"
                    class="custom-control-input sarrangement" @if (isset($post))
                    {{$post->arrangements->pluck('id')->contains($item->id) ? 'checked' : ''}} @endif>
                <label class="custom-control-label" for="arrangement-{{$key+1}}">{{$item->name}}</label>
            </div>
            @endforeach
        </div>
    </div>
</div>
{{-- end playlists --}}


</div>