     
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
        <li class="nav-item">
            <a href="{{route('Panel.ArtistList')}}" class="nav-link 
            @if(\Request::route()->getName() == "Panel.ArtistList") {{'active'}}
             @endif">لیست</a>
        </li>
        <li class="nav-item">
            <a href="{{route('Panel.AddArtist')}}" class="nav-link
   @if(\Request::route()->getName() == "Panel.AddArtist") {{'active'}}
    @endif">جدید <i class="fas fa-plus"></i></a>
        </li>
</ul>
     
    </div>
</div>
