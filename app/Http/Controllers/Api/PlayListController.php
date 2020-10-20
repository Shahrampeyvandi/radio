<?php

namespace App\Http\Controllers\Api;

use App\PlayList;
use App\UserPlaylist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class PlayListController extends Controller
{
    public $seconds = 60 * 5;
    public function latest()
    {
        if (Cache::has('playlists')) {
            return Response::json(Cache::get('playlists'), 200);
        }

        $playlists = PlayList::getLatest();
        $all = [];
        foreach ($playlists as $key => $item) {
            $array['id'] = $item->id;
            $array['name'] = $item->name;
            $array['image'] = asset($item->image);
            $all[] = $array;
        }
        Cache::put('playlists', $all, $this->seconds);

        return Response::json($all, 200);
    }

    public function get($id)
    {

        if (isset(request()->t)) {
            $playlist = UserPlaylist::find($id);
        } else {

            $playlist = PlayList::find($id);
            if (Cache::has('playlists-' . $playlist->id)) {
                return Response::json(Cache::get('playlists-' . $playlist->id), 200);
            }
        }
        $posts_array['playlist_name'] = $playlist->name;
        if ($playlist) {
            foreach ($playlist->tracks as $key => $track) {
                $post_array['title'] = $track->title;
                $post_array['type'] = $track->get_type();
                $post_array['singers'] = $track->singers();
                $post_array['translate'] = $track->description;
                $post_array['poster'] = $track->image('resize');
                $post_array['duration'] = $track->duration;
                $post_array['released'] = $track->released;
                $post_array['views'] = $track->views;
                $post_array['file'] = $track->file_url();
                $posts_array['posts'][] = $post_array;
            }
        }
        if (isset(\request()->t)) {
        } else {

            Cache::put('playlists-' . $playlist->id, $posts_array, $this->seconds);
        }
        return Response::json($posts_array, 200);
    }

    public function create(Request $request)
    {

        $member = $this->token(request()->header('Authorization'));
        if (!$member) return response()->json(['error' => 'unauthorized'], 401);

        
        if(UserPlaylist::whereName($request->name)->count()) {
            return response()->json(['error'=>'playlist exist'],200);
        }

        $playlist = UserPlaylist::create([
            'user_id' => $member->id,
            'name' => $request->name,
            'type' => 'music'
        ]);

        return response()->json([
            'name' => $playlist->name,
            'id' => $playlist->id,
            'poster' => $playlist->poster(),
            'playurl' => $playlist->api_url(),
        ], 200);
    }

    public function edit(Request $request)
    {


        $member = $this->token(request()->header('Authorization'));
        if (!$member) return response()->json(['error' => 'unauthorized'], 401);
        if (!$request->name) return response()->json(['error' => 'name is empty'], 200);
        $playlist = UserPlaylist::find($request->playlist_id);
        $playlist->name = $request->name;
        $playlist->update();

        return response()->json([
            'id' => $playlist->id,
            'name' => $playlist->name,
            'playurl' => $playlist->api_url()
        ], 200);
    }

    public function add_song_to_playlist(Request $request)
    {


        $member = $this->token(request()->header('Authorization'));
        if (!$member) return response()->json(['error' => 'unauthorized'], 401);

        $tracks = $request->track_ids;
        $playlist = UserPlaylist::find($request->playlist_id);

        if (count($request->track_ids)) {
            foreach ($tracks as $key => $track) {
                if ($playlist->tracks->contains($track)) {
                    $playlist->tracks()->detach($track);
                    $status = 'detach';
                } else {
                    $playlist->tracks()->attach($track);
                    $status = 'attach';
                }
            }
        } else {
            return response()->json(['error' => 'list is empty'], 200);
        }

        return response()->json(['status' => $status], 200);
    }

    public function userplaylists()
    {

        $member = $this->token(request()->header('Authorization'));
        if (!$member) return response()->json(['error' => 'unauthorized'], 401);
        $playlists = $member->playlists;
        $all = [];
        foreach ($playlists as $key => $playlist) {
            $array['id'] = $playlist->id;
            $array['name'] = $playlist->name;
            $array['poster'] = $playlist->poster();
            $array['tracks'] = PostResource::collection($playlist->tracks);
            $all[] = $array;
        }
        return response()->json($all, 200);
    }

    public function delete($id = null)
    {
        if(!$id) {
            return response()->json('not found', 200);
        }
        $playlist = UserPlaylist::find($id);
        if(!$playlist) {
            return response()->json('not found', 200);
        }
        $playlist->tracks()->detach();
        $playlist->delete();

        return response()->json('success', 200);



    }
}
