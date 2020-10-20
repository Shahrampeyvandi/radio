<?php

namespace App\Http\Controllers\Panel;

use App\Album;
use App\Arrangement;
use App\Artist;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lyric;
use App\PlayList;
use App\Tag;

class AjaxController extends Controller
{
    public function DeletePlayList(Request $request)
    {


        $playlist = PlayList::find($request->id);
        $playlist->posts()->detach();
        $playlist->delete();

        return response()->json('success', 200);
    }


    public function DeleteAlbum(Request $request)
    {
        $album = Album::find($request->id);
        $album->posts()->detach();
        $album->delete();

        return response()->json('success', 200);
    }

     public function DeleteCategory(Request $request)
    {
        $album = Category::find($request->id);
        $album->posts()->detach();
        $album->delete();

        return response()->json('success', 200);
    }

       public function DeleteLyric(Request $request)
    {
        $album = Lyric::find($request->id);
        $album->posts()->detach();
        $album->delete();

        return response()->json('success', 200);
    }

        public function DeleteArrangement(Request $request)
    {
        $album = Arrangement::find($request->id);
        $album->posts()->detach();
        $album->delete();

        return response()->json('success', 200);
    }
}
