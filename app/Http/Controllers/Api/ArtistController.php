<?php

namespace App\Http\Controllers\Api;

use App\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\ArtistResource;
use Illuminate\Support\Facades\Response;

class ArtistController extends Controller
{
    public function all()
    {

        $artists = Artist::orderBy('fullname', 'asc')->get();
        $data = ArtistResource::collection($artists);
        return Response::json($data, 200);
    }
    public function top()
    {
         if(isset(request()->count)){
            $count = request()->count;
        }else{
            $count = 20;
        }
        // return Artist::whereId(13)->first()->posts->sum('views');
        $artists = Artist::all()->sortByDesc(function ($artist) {
            return $artist->posts->sum('views');
        })->take($count);


        $data = ArtistResource::collection($artists);
        return Response::json($data, 200);
    }

    public function see_all()
    {
        $id = request()->id;
        $artist = Artist::find($id);
        $type = request()->type;
        $q = request()->q;
        $count = request()->count;
        $name = $q .'_'. $type . 's';
        $all =  $artist->$name($count);
        return Response::json(PostResource::collection($all), 200);
    }

    public function downloaded()
    {
        # code...
    }
}
