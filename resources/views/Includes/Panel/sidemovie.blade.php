<div class="col-md-4 right-side">
    <div class="cat">
        <div class="">
            <h6 class="">دسته بندی: </h6>
            <div>
                <div class="d-flex">
                    <input type="text" class="form-control mb-2" name="" id="pprev" placeholder="نام">
                    <input type="text" class="form-control mb-2" name="" id="prev" placeholder="نام لاتین">
                </div>
                <a href="#" class="btn btn-sm btn-primary mb-3"
                    onclick="addCategory(event,'{{route('Panel.AddCatAjax')}}')">افزودن</a>
            </div>
        </div>
        <div class="cat-wrapper card pr-2" style=" min-height:50px;max-height: 200px;overflow-y: scroll;">
            @foreach (\App\Category::all() as $key=>$item)
            <div class="custom-control custom-checkbox custom-control-inline ">
                <input type="checkbox" id="cat-{{$key+1}}" name="categories[]" value="{{$item->latin}}"
                    class="custom-control-input scat" @if (isset($post))
                    {{$post->categories->pluck('id')->contains($item->id) ? 'checked' : ''}} @endif>
                <label class="custom-control-label" for="cat-{{$key+1}}">{{$item->name}}</label>
            </div>
            @endforeach
        </div>
    </div>

 
   
    <div class="cast-wrapper mt-3">
        <h6 class="">بازیگران</h6>
        <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید" oninput="showActor(event)">
        <ul class="ul-list" style="display: none">
            <li><a href="#" onclick="addToInput(event)">ddd</a></li>
        </ul>
        <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addActor(event)">افزودن</a>
        <div class="actors-list card pr-2" style="min-height:50px;max-height: 200px;overflow-y: scroll;">
            @isset($post)
            @foreach ($post->actors()->orderBy('name','asc')->get() as $key=>$item)
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" id="actor-{{$key+1}}" name="actors[]" value="{{$item->name}}"
                    class="custom-control-input" checked>
                <label class="custom-control-label" for="actor-{{$key+1}}">
                    {{$item->name}}</label>
            </div>
            @endforeach

            @endisset
        </div>
    </div>
    <div class="cast-wrapper mt-3">
        <h6 class="">کارگردان</h6>
        <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید" oninput="showDirector(event)">
        <ul class="ul-list" style="display: none">
            <li><a href="#" onclick="addToInput(event)">ddd</a></li>
        </ul>
        <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addDirector(event)">افزودن</a>
        <div class="directors-list card pr-2" style="min-height:50px;max-height: 200px;overflow-y: scroll;">
            @isset($post)
            @foreach ($post->directors()->orderBy('name','asc')->get() as $key=>$item)
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" id="director-{{$key+1}}" name="directors[]" value="{{$item->name}}"
                    class="custom-control-input" checked>
                <label class="custom-control-label" for="director-{{$key+1}}">
                    {{$item->name}}</label>
            </div>
            @endforeach

            @endisset
        </div>
    </div>

    <div class="languages-wrapper mt-3">
        <h6 class="">زبان</h6>
        <input type="text" class="form-control mb-2" name="" id="" placeholder="جدید">
        <a href="#" class="btn btn-sm btn-primary mb-3" onclick="addLanguage(event)">افزودن</a>
        <div class="lang-list card pr-2" style="min-height:50px;max-height: 200px;overflow-y: scroll;">
            @foreach (\App\Language::all() as $key => $language)
            <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" id="ln-{{$key+1}}" name="languages[]" value="{{$language->name}}"
                    @if(isset($post)) {{$post->languages->pluck('id')->contains($language->id) ? 'checked' : ''}} @endif
                    class="custom-control-input">
                <label class="custom-control-label" for="ln-{{$key+1}}">
                    {{$language->name}}</label>
            </div>
            @endforeach
        </div>
    </div>
 

    <div class="mt-3">
        <label class="" for="">
        </label>
        <select name="age" id="age" class="form-control custom-select">
            <option value="all" {{isset($post) && $post->age_rate == 'all' ? 'selected' : ''}}>
                مناسب همه سنین</option>
            <option value="18" {{isset($post) && $post->age_rate == '18' ? 'selected' : ''}}>مثبت 18 </option>
            <option value="12" {{isset($post) && $post->age_rate == '12' ? 'selected' : ''}}>مثبت 12</option>
        </select>
    </div>

</div>

<input type="hidden" name="imdbID" id="imdbID">
<input type="hidden" name="imdbVotes" id="imdbVotes">
<input type="hidden" name="imdbRating" id="imdbRating">
<input type="hidden" name="top250" id="top250">