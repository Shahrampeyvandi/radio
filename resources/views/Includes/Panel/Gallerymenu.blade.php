     
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
        <li class="nav-item">
            <a href="{{route('Panel.GalleryList')}}" class="nav-link 
            @if(\Request::route()->getName() == "Panel.GalleryList") {{'active'}}
             @endif">لیست</a>
        </li>
        <li class="nav-item">
            <a href="{{route('Panel.AddGallery')}}" class="nav-link
   @if(\Request::route()->getName() == "Panel.AddGallery") {{'active'}}
    @endif">جدید <i class="fas fa-plus"></i></a>
        </li>
</ul>
     
    </div>
</div>
