<?php

namespace App;

use CategoryVideo;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $guarded = ['id'];
    // protected $with = ['quality','captions'];

    public function fileble()
    {
        return $this->morphTo();
    }

    public function quality()
    {
        return $this->belongsTo(Quality::class,'quality_id');
    }
     public function captions()
    {
        return $this->hasMany(Caption::class);
    }
}
