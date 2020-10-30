<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayList extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
       
        'image' => 'array',
    ];
    

    protected $with = ['tracks'];

    public static function check($id)
    {
        if ($obj = static::where('id', $id)->first()) {
            return $obj->id;
        } else {
            return null;
        }
    }

     public function playurl()
    {
        return route('Play.Playlist',['id'=>$this->id]).'?type=c';
    }
       public function tracks()
    {
        return $this->belongsToMany(Post::class, 'post_playlist','play_list_id','post_id');
    }

    public static function getLatest($count = 8)
    {
       return  static::latest()->take($count)->get();
    }

}
