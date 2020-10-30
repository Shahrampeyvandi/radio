<?php

namespace App;

use CategoryVideo;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';
    protected $guarded = ['id'];
    // protected $with = ['quality','captions'];
    const Status_New = 0;
    const Status_Converting = 1;
    const Status_Converted = 2;
    const Status_Convert_Failed = 3;



    public function _status($status = '')
    {
        $arr = [
            self::Status_New => 'New',
            self::Status_Converting => 'In Progress',
            self::Status_Converted => 'Converted',
            self::Status_Convert_Failed => 'Failed',
        ];
        if ($status !== '') {
            if (isset($arr[$status]))
                return $arr[$status];
            return '---';
        }
        return $arr;
    }
    public function fileble()
    {
        return $this->morphTo();
    }

    public function quality()
    {
        return $this->belongsTo(Quality::class, 'quality_id');
    }
    public function captions()
    {
        return $this->hasMany(Caption::class);
    }
}
