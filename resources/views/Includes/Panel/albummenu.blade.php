     
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
        <li class="nav-item">
            <a href="{{route('Panel.Album')}}" class="nav-link 
            @if(\Request::route()->getName() == "Panel.Album") {{'active'}}
             @endif">لیست</a>
        </li>
        <li class="nav-item">
            <a href="{{route('Panel.AddAlbum')}}" class="nav-link
   @if(\Request::route()->getName() == "Panel.AddAlbum") {{'active'}}
    @endif">جدید <i class="fas fa-plus"></i></a>
        </li>
</ul>
     
    </div>
</div>
