<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPlaylist extends Model
{
    protected $guarded = ['id'];
    protected $table = 'uplaylists';
    protected $with = 'tracks';
      public function tracks()
    {
        return $this->belongsToMany(Post::class, 'uplaylist_track', 'playlist_id', 'track_id');
    }
    public function playurl()
    {
        return route('Play.Playlist',['id'=>$this->id]).'?type=u';
    }
     public function addurl()
    {
        return route('Ajax.AddToPlaylist');
    }

    public function poster()
    {
        $first_track = $this->tracks->first();
        if($first_track) {
            return asset($first_track->image('resize'));
        }
        return asset('frontend/images/logo_101.png');
    }

    public function api_url()
    {
        return route('MainUrl') . '/playlists/' . $this->id . '?t=user';
    }

   
}


