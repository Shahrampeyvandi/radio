@if (isset($playlists) && count($playlists))
<div class="container mt-2">
    <div class="row  justify-content-between">
        <div class="col">
            <div class="sectionTitle">
                <h2 class="title">Playlists</h2>
            </div>
        </div>
       @if ($playlist_more)
            <div class="col text-right">
            <a class="viewMore button primaryButton" href="{{route('Playlists')}}">View More</a>
        </div>
       @endif
    </div>
    <div class="">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($playlists as $playlist)
                <div class="swiper-slide text-center mb-lg-5">
                    @component('components.playlist-item',['playlist'=>$playlist,'songs'=>count($playlist->tracks)])
                    @endcomponent
                </div>
                @endforeach
            </div>
            <!-- Add Scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>
    </div>
</div>
@endif