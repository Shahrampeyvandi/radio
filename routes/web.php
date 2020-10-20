<?php

Route::get('/admin/login', 'Panel\LoginController@Login')->name('Admin.Login');
Route::post('/admin/login', 'Panel\LoginController@Verify')->name('Admin.Login');

// q]Ahy;dA~mmk
Route::get('/login', 'Front\LoginController@Login')->name('login');
Route::post('/login', 'Front\LoginController@Verify')->name('login');
Route::get('/register', 'Front\LoginController@Register')->name('S.Register');
Route::post('/register', 'Front\LoginController@ConfirmRegister')->name('S.Register');

Route::get('/logout', 'Front\LoginController@logout')->name('logout');

Route::group(['middleware' => ['admin'], 'prefix' => 'panel'], function () {
    Route::get('/', 'Panel\DashboardController@Index')->name('BaseUrl');
    Route::get('/logout', function () {
        Auth::guard('admin')->logout();
        return redirect()->route('Admin.Login');
    })->name('logout');

    Route::get('music/add', 'Panel\MusicController@Add')->name('Panel.AddMusic');
    Route::post('music/add', 'Panel\MusicController@Save')->name('Panel.AddMusic');
    Route::put('music/add', 'Panel\MusicController@EditPost')->name('Panel.AddMusic');
    Route::get('users', 'Panel\UserController@List')->name('Panel.UserList');
    Route::delete('user/delete', 'Panel\UserController@Delete')->name('Panel.DeleteUser');
    Route::get('user/edit/{id}', 'Panel\UserController@Edit')->name('Panel.EditUser');
    Route::post('user/edit/{id}', 'Panel\UserController@SubmitEdit')->name('Panel.EditUser');

    Route::post('user/add', 'Panel\UserController@Add')->name('Panel.AddUser');
    Route::get('rvideo/add', 'Panel\VideoController@Add')->name('Panel.AddVideo');
    Route::post('rvideo/add', 'Panel\VideoController@Save')->name('Panel.AddVideo');


    Route::get('music/list', 'Panel\MusicController@MusicList')->name('Panel.MusicList');
    Route::get('video/list', 'Panel\VideoController@VideoList')->name('Panel.VideoList');


    Route::get('artist/list', 'Panel\ArtistController@List')->name('Panel.ArtistList');
    Route::get('artist/add', 'Panel\ArtistController@Add')->name('Panel.AddArtist');
    Route::post('artist/add', 'Panel\ArtistController@Save')->name('Panel.AddArtist');
    Route::get('artist/edit/{artist}', 'Panel\ArtistController@Edit')->name('Panel.EditArtist');
    Route::post('artist/edit/{artist}', 'Panel\ArtistController@EditSave')->name('Panel.EditArtist');
    Route::delete('artist/delete', 'Panel\ArtistController@Delete')->name('Panel.DeleteArtist');

    Route::get('playlists', 'Panel\PlaylistController@List')->name('Panel.PlayList');
    Route::get('playlist/add', 'Panel\PlaylistController@Add')->name('Panel.AddPlayList');
    Route::post('playlist/add', 'Panel\PlaylistController@Save')->name('Panel.AddPlayList');
    Route::get('playlist/edit/{PlayList}', 'Panel\PlaylistController@Edit')->name('Panel.EditPlayList');
    Route::post('playlist/edit/{PlayList}', 'Panel\PlaylistController@EditSave')->name('Panel.EditPlayList');
    Route::delete('playlist/delete', 'Panel\PlaylistController@Delete')->name('Panel.DeletePlayList');
    Route::post('playlist/changefeatured', 'Panel\PlaylistController@ChangeFeatured')->name('Panel.ChangeFeatured');



    Route::get('albums', 'Panel\AlbumController@List')->name('Panel.Album');
    Route::get('album/add', 'Panel\AlbumController@Add')->name('Panel.AddAlbum');
    Route::post('album/add', 'Panel\AlbumController@Save')->name('Panel.AddAlbum');
    Route::get('album/edit/{album}', 'Panel\AlbumController@Edit')->name('Panel.EditAlbum');
    Route::post('album/edit/{album}', 'Panel\AlbumController@EditSave')->name('Panel.EditAlbum');

    Route::get('music/{post}', 'Panel\MusicController@Edit')->name('Panel.EditMusic');
    Route::post('music/{post}', 'Panel\MusicController@EditMusic')->name('Panel.EditMusic');

    Route::get('video/{post}', 'Panel\VideoController@Edit')->name('Panel.EditVideo');
    Route::post('video/{post}', 'Panel\VideoController@EditVideo')->name('Panel.EditVideo');


    Route::post('delete/playlist', 'Panel\AjaxController@DeletePlayList')->name('DeletePlayList');
    Route::delete('delete/album', 'Panel\AlbumController@Delete')->name('Panel.DeleteAlbum');
    Route::post('delete/category', 'Panel\AjaxController@DeleteCategory')->name('DeleteCategory');

    Route::post('delete/lyric', 'Panel\AjaxController@DeleteLyric')->name('DeleteLyric');
    Route::post('delete/arrangement', 'Panel\AjaxController@DeleteArrangement')->name('DeleteArrangement');
    Route::get('gallery/list', 'Panel\GalleryController@List')->name('Panel.GalleryList');

    Route::get('gallery/add', 'Panel\GalleryController@Add')->name('Panel.AddGallery');
    Route::post('gallery/add', 'Panel\GalleryController@Save')->name('Panel.AddGallery');
    Route::get('gallery/{post}', 'Panel\GalleryController@Edit')->name('Panel.EditGallery');
    Route::post('gallery/{post}', 'Panel\GalleryController@EditGallery')->name('Panel.EditGallery');
    Route::delete('gallery', 'Panel\GalleryController@DeleteGallery')->name('Panel.DeleteGallery');
    Route::delete('delete/image', 'Panel\AjaxController@DeleteImage')->name('Panel.DeleteImage');



    Route::delete('post/delete', 'Panel\MusicController@DeletePost')->name('Panel.DeletePost');

    Route::post('post/filter', 'Panel\MusicController@FilterPosts')->name('FilterPosts');
    
    Route::delete('video/delete', 'Panel\MusicController@DeleteVideo')->name('Panel.DeleteVideo');



    Route::get('sendmessage', 'Panel\MessageController@Add')->name('Panel.SendMessage');
    Route::post('sendmessage', 'Panel\MessageController@Send')->name('Panel.SendMessage');

    Route::get('comments/unconfirmed', 'Panel\CommentController@UnconfirmedComments')->name('Panel.UnconfirmedComments');
    Route::get('comments/confirmed', 'Panel\CommentController@ConfirmedComments')->name('Panel.ConfirmedComments');
    Route::get('setting', 'Panel\SettingController@Show')->name('Panel.Setting');
    Route::post('setting', 'Panel\SettingController@Save')->name('Panel.Setting');

    Route::post('ajax/category', 'Panel\MusicController@AddCatAjax')->name('Panel.AddCatAjax');
    Route::post('ajax/checkname', 'Panel\MusicController@checkNameAjax')->name('Panel.checkNameAjax');
    Route::post('ajax/caption/delete', 'Panel\VideoController@DeleteCaption')->name('Ajax.DeleteCaption');

    Route::post('ajax/file/delete', 'Panel\VideoController@DeleteFile')->name('Ajax.DeleteFile');


    // Movie And Serie
     Route::post('upload-image', 'Panel\BlogController@UploadImage')->name('UploadImage');
     Route::get('movie/add', 'Panel\MoviesController@Add')->name('Panel.AddMovie');
    Route::post('movie/add', 'Panel\MoviesController@Save')->name('Panel.AddMovie');
    Route::put('movie/add', 'Panel\MoviesController@EditPost')->name('Panel.AddMovie');
    Route::get('users', 'Panel\UserController@List')->name('Panel.UserList');
    Route::post('user/add', 'Panel\UserController@Add')->name('Panel.AddUser');
    Route::get('user/edit/{user}', 'Panel\UserController@Edit')->name('Panel.EditUser');
    Route::post('user/edit/{user}', 'Panel\UserController@SaveEdit')->name('Panel.EditUser');
    Route::get('series/add', 'Panel\SeriesController@Add')->name('Panel.AddSerie');
    Route::post('series/add', 'Panel\SeriesController@Save')->name('Panel.AddSerie');
    Route::delete('user/delete', 'Panel\UserController@Delete')->name('Panel.DeleteUser');
    Route::get('movies/list', 'Panel\MoviesController@MoviesList')->name('Panel.MoviesList');
    Route::get('series/list', 'Panel\SeriesController@SeriesList')->name('Panel.SeriesList');
    Route::get('series/{serie}/season/add', 'Panel\SeriesController@AddSeason')->name('Panel.AddSeason');
    Route::post('series/{serie}/season/add', 'Panel\SeriesController@InsertSeason')->name('Panel.AddSeason');
    Route::delete('series/season/delete', 'Panel\SeriesController@DeleteSeason')->name('Panel.DeleteSeason');
    Route::get('series/season/{season}', 'Panel\SeriesController@EditSeason')->name('Panel.EditSeason');
    Route::post('series/season/{season}', 'Panel\SeriesController@SaveEditSeason')->name('Panel.EditSeason');
    Route::post('series/section/ajax/imdb', 'Panel\SeriesController@getSectionImdbData')->name('Panel.getSectionImdbData');
    Route::get('series/addsection/{id}', 'Panel\SeriesController@AddSection')->name('Panel.AddSection');
    Route::post('series/addsection/{id}', 'Panel\SeriesController@InsertSection')->name('Panel.AddSection');
    Route::delete('series/section/delete', 'Panel\SeriesController@DeleteSection')->name('Panel.DeleteSection');
    Route::get('series/section/{section}', 'Panel\SeriesController@EditSection')->name('Panel.EditSection');
    Route::post('series/section/{section}', 'Panel\SeriesController@SaveEditSection')->name('Panel.EditSection');
    Route::post('ajax/series/all', 'Panel\SeriesController@GetSeriesAjax')->name('Panel.Ajax.Series');
    Route::get('movie/{post}', 'Panel\MoviesController@Edit')->name('Panel.EditMovie');
    Route::post('movie/{post}', 'Panel\MoviesController@EditMovie')->name('Panel.EditMovie');
    Route::get('serie/{post}', 'Panel\SeriesController@Edit')->name('Panel.EditSerie');
    Route::post('serie/{post}', 'Panel\SeriesController@EditSerie')->name('Panel.EditSerie');

    
    Route::post('ajax/caption/delete', 'Panel\MoviesController@DeleteCaption')->name('Ajax.DeleteCaption');

    Route::post('ajax/actor/get', 'Panel\ActorsController@GetActorAjax')->name('Panel.Ajax.GetActor');
    Route::post('ajax/director/get', 'Panel\ActorsController@GetDirectorAjax')->name('Panel.Ajax.GetDirector');
    Route::post('ajax/category', 'Panel\MoviesController@AddCatAjax')->name('Panel.AddCatAjax');
    Route::post('ajax/checkname', 'Panel\MoviesController@checkNameAjax')->name('Panel.checkNameAjax');
    Route::post('imdb/get', 'Panel\ImdbController@Get')->name('Panel.GetImdb');

    // End Movie And Serie
});


Route::group([], function () {
    Route::get('/', 'Front\MainController@index')->name('MainUrl');
    Route::get('musics/{slug}', 'Front\MusicController@Show')->name('ShowMusic');
    Route::get('podcasts/{slug}', 'Front\MusicController@Show')->name('ShowPodcast');

    Route::get('/testapi', 'Panel\ImdbController@testApi')->name('Test.Api');
    Route::get('/mp3s', 'Front\MusicController@All')->name('Mp3s');
    Route::get('/musicvideos', 'Front\VideoController@All')->name('Videos');
    Route::get('/musicvideo/{slug}', 'Front\VideoController@Show')->name('ShowVideo');
    Route::get('/play/playlist/{id}', 'Front\PlayListController@play')->name('Play.Playlist');
    Route::get('/edit/playlist/{id}', 'Front\PlayListController@Edit')->name('Play.EditPlaylist');
    Route::post('/myplaylist/edit-name', 'Front\PlayListController@edit_name');
    Route::post('/myplaylist/delete', 'Front\PlayListController@delete');

    Route::post('/myplaylist/track/delete', 'Front\PlayListController@DeleteTrack')->name('UserPlaylist.Delete');

    Route::get('/playlists/list', 'Front\PlayListController@All')->name('Playlists');
    


    Route::get('/series', 'Front\SerieController@All')->name('AllSeries');
    Route::get('/childs', 'Front\ChildController@Show')->name('Childrens');
    Route::get('/categories', 'Front\CategoryController@All')->name('Categories');
    Route::get('/category/{name}', 'Front\CategoryController@Show')->name('Category.Show');
    Route::post('/addcomment/{post}', 'Front\CommentController@Save')->name('SaveComment');
    Route::post('/getcomment/{post}/ajax', 'Front\CommentController@getCommentAjax')->name('GetCommentAjax');
    Route::post('/ajax/getmoviedetail', 'Front\AjaxController@getMovieDetail')->name('GetMovieDetail');
    Route::get('/logout', 'Front\LoginController@logout')->name('logout-user');
    Route::get('/download/{id}', 'Front\MainController@DownLoad')->name('DownLoad');
    Route::get('/myfavorite', 'Front\MainController@MyFavorite')->name('S.MyFavorite');
    Route::get('/showall', 'Front\MainController@ShowMore')->name('S.ShowMore');
    // Route::get('/category/{slug}', 'Front\MainController@ShowMore')->name('S.ShowMore');
    Route::get('/play/{slug}', 'Front\MainController@Play')->name('S.Play');
    Route::get('/play/{slug}/{season}/{section}', 'Front\MainController@Play')->name('S.Series.Play');

    Route::get('photos', 'Front\GalleryController@All')->name('Photos');
    Route::get('photos/{slug}', 'Front\GalleryController@Show')->name('ShowGallery');


    Route::get('album/{slug}', 'Front\AlbumController@Play')->name('Play.Album');
    Route::get('artist/{slug}', 'Front\ArtistController@Show')->name('Artist.Show');

    Route::get('filter', 'Front\ArtistController@Filter')->name('Filter');

    Route::get('profile', 'Front\UserController@Profile')->name('Profile');
    Route::post('profile', 'Front\UserController@EditProfile')->name('Profile');

    Route::post('ajax/checktakhfif', 'Front\AjaxController@checkTakhfif')->name('checkTakhfif');
    Route::post('ajax/search', 'Front\AjaxController@Search')->name('Ajax.Search');
    Route::post('ajax/favorite', 'Front\AjaxController@addToFavorite')->name('S.addToFavorite');
    Route::post('ajax/getplaylists', 'Front\AjaxController@getPlaylists')->name('Ajax.GetPlayLists');
    Route::post('ajax/newplaylist', 'Front\AjaxController@newPlaylist')->name('Ajax.NewPlaylist');
    Route::post('ajax/addtoplaylist', 'Front\AjaxController@addToPlaylist')->name('Ajax.AddToPlaylist');

    Route::post('delete-myplaylist', 'Front\AjaxController@DeletePlaylist')->name('Ajax.DeletePlaylist');

    Route::post('ajax/likepost', 'Front\AjaxController@LikePost')->name('Ajax.LikePost');
    Route::get('download', 'Front\AjaxController@DownLoad')->name('Ajax.DownLoad');
    Route::post('addplaycount', 'Front\AjaxController@AddPlay')->name('Ajax.AddPlay');
});
