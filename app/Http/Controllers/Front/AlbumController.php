<?php

namespace App\Http\Controllers\Front;

use App\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    public function Play($slug)
    { 
        
        $album = Album::whereSlug($slug)->first();
        if(!$album) abort(404);
        $all = $album->posts;
        
      
        $data['post'] = $all->first();
        $data['title'] = $album->name;
        $data['type'] = $all->first()->type;
        $data['album'] = $album;
        $array = [];
        foreach ($all as $key => $item) {

             $array[] = [
                'id' => $item->id,
                'name' => $item->title,
                'artist' => $item->singers(),
                'image' => $item->image('resize'),
                'path' => $item->file_url(),
                'lyric' => $item->description,
                'likes' => count($item->votes),
                'views' => $item->views,
                'released' => $item->released ? $item->released : null
            ];
        }



        $data['track_lists'] = json_encode($array);

        return view(
            'Front.show-music',
            $data
        );
    }
}
