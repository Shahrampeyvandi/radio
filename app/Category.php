<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $guarded = ['id'];
    public $timestamps = false;

   public static function check($name)
   {
       if($obj = static::where('name',$name)->first()){
            return $obj->id;
       }else{
           return null;
       }
   }

     public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id');
    }


    public function lastPosts()
    {
        if(strtolower($this->name) == 'new song'){

            return $posts = $this->posts()->whereDate('created_at', '>', Carbon::now()->subDays(12)->toDateString())->latest()->take(8)->get();
        }else{
            return $posts = $this->posts()->whereDate('created_at', '>', Carbon::now()->subDays(12)->toDateString())->latest()->take(8)->get();

        }
    }
}
