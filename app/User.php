<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  implements JWTSubject
{
    use Notifiable;

    protected $guarded  = [
        'id'
    ];

    protected $hidden = ['password','remember_token'];

      public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [
            'email'      => $this->email,
          
        ];
    }

   

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plan_user', 'user_id', 'plan_id');
    }

     public function followings()
    {
        return $this->belongsToMany(Artist::class, 'artist_follower', 'user_id', 'artist_id');
    }

    
    public function downloaded()
    {
        return $this->belongsToMany(Post::class, 'user_download', 'user_id', 'post_id');
    }

    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }



      public function playlists()
    {
        return $this->hasMany(UserPlaylist::class);
    }


    public function liked_posts()
    {
       return $posts = Post::whereHas('votes',function($q){
            $q->where('user_id',$this->id);
        })->get();
    }
   
   

   
}
