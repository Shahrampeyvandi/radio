<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];
    
    public function commentable()
    {
        return $this->morphTo();
    }

      public function members()
    {
        return $this->belongsTo('App\User');
    }
    public function setTextAttribute($value)
    {
        return $this->attributes['text']= nl2br($value);
    }

    public function votes()
    {
        return $this->belongsToMany(Vote::class, 'comment_vote', 'comment_id', 'vote_id');
    }
}
