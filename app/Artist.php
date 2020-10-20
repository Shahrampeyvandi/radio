<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use Sluggable;
    protected $guarded = ['id'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'fullname'
            ]
        ];
    }
    public static function check($name)
    {
        if ($obj = static::where('id', $name)->first()) {
            return $obj->id;
        } else {
            return null;
        }
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_artist');
    }
    public function albums()
    {
        return $this->belongsToMany(Album::class, 'artist_album');
    }
    // public function albums()
    // {
    //     foreach ($this->posts as $key => $post) {

    //     }
    // }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'artist_follower', 'artist_id', 'user_id');
    }

    public function top_songs($count = 5)
    {
        return $this->posts()->where('type', 'music')->withCount('votes')->take($count)->get()->sortByDesc(function ($post) {
            return $post->votes->count();
        });
    }

    public function latest_songs($count = 1)
    {
        return $this->posts()->where('type', 'music')->latest()->take($count)->get();
    }

    public function top_videos($count = 5)
    {
        return $this->posts()->where('type', 'video')->withCount('votes')->take($count)->get()->sortByDesc(function ($post) {
            return $post->votes->count();
        });
    }

    public function latest_videos($count = 1)
    {
        return $this->posts()->where('type', 'video')->latest()->take($count)->get();
    }


    public function url()
    {
        return route('Artist.Show', ['slug' => $this->slug]);
    }
    public function image($size)
    {
        $data = @unserialize($this->photo);
        if ($data == true && !is_null(unserialize($this->photo)["$size"])) {

            $resize = unserialize($this->photo)["$size"];
            return asset($resize);
        } else {
            if ($size == 'resize') return asset('frontend/images/logo_101.png');
            if ($size == 'banner') return asset('frontend/images/logo_100.png');
        }
    }
}
