
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
            <a href="{{route('Panel.MusicList')}}" class="nav-link 
@if(\Request::route()->getName() == "Panel.MusicList" || \Request::route()->getName() == "FilterPosts") {{'active'}} 
            @endif">لیست</a>
        </li>
        <li class="nav-item">
            <a href="{{route('Panel.AddMusic')}}" class="nav-link
   @if(\Request::route()->getName() == "Panel.AddMusic") {{'active'}} 
   @endif">جدید <i class="fas fa-plus"></i></a>
        </li>
          
</ul>
 </div>
</div>
