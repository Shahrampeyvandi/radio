<?php

Route::post('register','Api\AuthController@register');
Route::post('login','Api\AuthController@login');
Route::post('forget-pass','Api\AuthController@forgetpass');



Route::get('get','Api\MainController@index');
Route::get('songs/all','Api\MainController@all');

Route::get('playlists/latest','Api\PlayListController@latest');
Route::get('playlists/{id}','Api\PlayListController@get');
Route::get('featured','Api\MainController@featured');
Route::get('newsongs','Api\MainController@newsongs');
Route::get('hot-tracks','Api\MainController@hot_tracks');
Route::get('get-post/{id}','Api\MainController@get_post');
Route::get('get-artist/{id}','Api\MainController@get_artist');
Route::get('artist/{id}/all-songs','Api\MainController@artist_songs');

Route::post('artist/see-all','Api\ArtistController@see_all');

Route::get('artists/all','Api\ArtistController@all');
Route::get('artists/top','Api\ArtistController@top');

Route::get('search','Api\MainController@search');


Route::post('like-post','Api\UserController@like_post');
Route::get('liked-posts','Api\UserController@liked_posts');

Route::get('user/download/{id}','Api\UserController@download');
Route::get('follow-artist/{id}','Api\UserController@follow');
Route::get('user/followings','Api\UserController@get_followings');

Route::get('user/downloaded','Api\UserController@downloaded');

Route::post('userplaylist/create','Api\PlayListController@create');
Route::post('userplaylist/edit','Api\PlayListController@edit');
Route::delete('userplaylist/{id}','Api\PlayListController@delete');
Route::get('userplaylists','Api\PlayListController@userplaylists');

Route::post('userplaylist/addsongs','Api\PlayListController@add_song_to_playlist');

Route::post('profile/update','Api\AuthController@update_profile');

Route::get('track/addplay','Api\MainController@AddPlay');





// https://radioavin.com/api/artists/top ** method GET ** params => count:(number) default=20
// https://radioavin.com/api/artist/see-all  ** method POST *** params =>   id:(artist_id) , type:(song | video) , q: (top | latest )  , count:(tedad)
// https://radioavin.com/api/playlists/latest  ** method GET 
// https://radioavin.com/api/songs/all  ** method GET ** params => page:(number) 
// https://radioavin.com/api//artists/all * method get **
// https://radioavin.com/api/featured  ** method GET ** params => count:(number) default=10 
// https://radioavin.com/api/newsongs  ** method GET ** params => count:(number) default=10
// https://radioavin.com/api/hot-tracks  ** method GET ** params => count:(number) default=10


// https://radioavin.com/api/get-post/{post_id}   ****method GET 
// https://radioavin.com/api/get-artist/{artist_id} **** method GET
// https://radioavin.com/api/artist/see-all  ** method POST *** body =>   id:(artist_id) , type:(song | video) , q: (top | latest )  , count:(tedad)
// https://radioavin.com/api/search ***** method GET *** params: ( key , q )  **   if (q == singer ) => return all singers     ** if (q == song ) => return all songs **     if( ! q ) => return songs and artists
