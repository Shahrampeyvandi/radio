<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mcategory extends Model
{


    protected $guarded = ['id'];
    
    public $timestamps = false;

   public static function check($name)
   {
       if($obj = static::where('latin',$name)->first()){
            return $obj->id;
       }else{
           return null;
       }
   }

   public function getImage()
   {
       return $this->image ? $this->image : "frontend/assets/images/category/cat13.jpg";
   }

   public function path()
   {
      return route('S.ShowMore') .'?c='.strtolower($this->latin).'&type=all';
       
   }

   public function posts()
    {
        return $this->belongsToMany(Movie::class, 'movie_categories', 'category_id', 'movie_id');
    }
}
