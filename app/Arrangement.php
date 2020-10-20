<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arrangement extends Model
{
    protected $guarded = ['id'];
    public static function check($name)
    {
        if ($obj = static::where('name', $name)->first()) {
            return $obj->id;
        } else {
            return null;
        }
    }

      public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_arrangement', 'arrangement_id', 'post_id');
    }
}
