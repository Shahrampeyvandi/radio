<?php

namespace App\Http\Controllers\Api;

use App\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AlbumResource;
use Illuminate\Support\Facades\Response;

class AlbumController extends Controller
{
     public function latest()
    {
        // if (Cache::has('playlists')) {
        //     return Response::json(Cache::get('playlists'), 200);
        // }

        $albums = Album::getLatest(request()->count);
     
       
        return Response::json(AlbumResource::collection($albums), 200);
    }
}
