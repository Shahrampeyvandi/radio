<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mlanguage extends Model
{
   
    protected $guarded = ['id'];
    
    public static function check($name)
   {
       
       if($obj = static::where('name',$name)->first()){
          
            return $obj->id;
       }else{
           return null;
       }
   }
}
