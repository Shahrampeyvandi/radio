<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PlayList;
use App\UserPlaylist;

class PlayListController extends Controller
{

    public function All()
    {
        $data['title'] = 'Play Lists';
        $data['featured'] = PlayList::where('featured', 1)->latest()->get();
        $data['browse'] = PlayList::where('featured', 0)->latest()->get();
        if (auth()->check()) {
            $data['my_playlists'] = auth()->user()->playlists;
            //  dd($data['my_playlists']->first()->image);
        }
        return view('Front.playlists', $data);
    }

    public function play($id)
    {
        if (request()->type) {
            if (request()->type == 'c') {
                $playlist = Playlist::find($id);
                $all = $playlist->tracks;
                if (count($all) == 0) return back();
            } elseif (request()->type == 'u') {
                $playlist = UserPlaylist::find($id);
                $all = $playlist->tracks;
                if (count($all) == 0) return back();
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }


        $title = $all->first()->title;
        $data['post'] = $all->first();
        $data['playlist'] = $playlist;
        $data['title'] = $title;
        $data['type'] = $all->first()->type;
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

    public function Edit($id)
    {

        $playlist  = UserPlaylist::find($id);
        return view('Front.edit-playlist',['playlist'=>$playlist]);
    }

    public function edit_name(Request $request)
    {
       
       $playlist = UserPlaylist::find($request->id);
       $playlist->name = $request->name;
       $playlist->update();
       return back();
    }
      public function delete(Request $request)
    {
       
       $playlist = UserPlaylist::find($request->id);
     $playlist->tracks()->detach();

       $playlist->delete();
       return redirect()->route('MainUrl');
    }
     public function DeleteTrack() 
    {
         $playlist = UserPlaylist::find(request()->playlist_id);
         $playlist->tracks()->detach(request()->id);
         return back();
    }
}
