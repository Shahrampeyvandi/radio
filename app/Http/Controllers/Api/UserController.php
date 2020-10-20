<?php

namespace App\Http\Controllers\Api;

use App\Artist;
use App\Post;
use App\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function like_post()
    {

        // return request()->header('Authorization');
        $member = $this->token(request()->header('Authorization'));
        if (!$member) return response()->json(['error' => 'unauthorized'], 401);

        $id = request()->id;
        $post = Post::whereId($id)->first();

        if (count($post->votes->where('user_id', $member->id)) == 0) {

            Vote::create([
                'votable_id' => $post->id,
                'votable_type' => 'App\Post',
                'user_id' => $member->id,
                'status' => 1
            ]);

            return response()->json(['likes' => count($post->votes), 'status' => true], 200);
        } else {
            return response()->json(['likes' => count($post->votes), 'status' => false], 200);
        }
    }

    public function liked_posts()
    {
        $member = $this->token(request()->header('Authorization'));
        if (!$member) return response()->json(['error' => 'unauthorized'], 401);
        return response()->json(['posts' => PostResource::collection($member->liked_posts())], 200);
    }
    public function download($post_id)
    {
        $member = $this->token(request()->header('Authorization'));
        if (!$member) return response()->json(['error' => 'unauthorized'], 401);
        $member->downloaded()->attach($post_id);
        return response()->json('success', 200);
    }

    public function downloaded()
    {
        $member = $this->token(request()->header('Authorization'));
        if (!$member) return response()->json(['error' => 'unauthorized'], 401);
        return response()->json(['posts' => PostResource::collection($member->downloaded)], 200);
    }

    public function follow($id)
    {
        $member = $this->token(request()->header('Authorization'));
        if (!$member) return response()->json(['error' => 'unauthorized'], 401);

        $artist = Artist::find($id);
        if ($artist) {
            if ($member->followings->contains($id)) {
                $member->followings()->detach($id);
                $status = 'artist unfollowed';
            } else {
                $member->followings()->attach($id);
                $status = 'artist followed';
            }
          
            return response()->json(['status' => $status], 200);
        } else {
            return response()->json(['error' => 'artist not found'], 200);
        }
    }

    public function get_followings()
    {
        $member = $this->token(request()->header('Authorization'));
        if (!$member) return response()->json(['error' => 'unauthorized'], 401);

        return response()->json(['artists' => ArtistResource::collection($member->followings()->orderBy('fullname','asc')->get())], 200);
    }
}
