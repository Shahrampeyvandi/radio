     
<div class="card">
    <div class=" card-body ">
   
<ul class="nav nav-pills ">
        <li class="nav-item">
            <a href="{{route('Panel.PlayList')}}" class="nav-link 
            @if(\Request::route()->getName() == "Panel.PlayList") {{'active'}}
             @endif">لیست</a>
        </li>
        <li class="nav-item">
            <a href="{{route('Panel.AddPlayList')}}" class="nav-link
   @if(\Request::route()->getName() == "Panel.AddPlayList") {{'active'}}
    @endif">جدید <i class="fas fa-plus"></i></a>
        </li>
</ul>
     
    </div>
</div>
