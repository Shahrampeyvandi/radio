<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    protected $guarded = ['id'];

    protected $casts = [
        'awards' => 'array',
        'poster' => 'array',
    ];



    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'post_album', 'post_id', 'album_id');
    }

    public function playlists()
    {
        return $this->belongsToMany(PlayList::class, 'post_playlist', 'post_id', 'play_list_id');
    }
    public function captions()
    {
        return $this->morphMany(Caption::class, 'captionable');
    }
    public function files()
    {
        return $this->morphMany(File::class, 'fileble');
    }
    // image and comment may be for videos or blogs

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    // votes may be for videos or comments
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'post_artist', 'post_id', 'artist_id');
    }

    public function arrangements()
    {
        return $this->belongsToMany(Arrangement::class, 'post_arrangement', 'post_id', 'arrangement_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    public function singers()
    {
        $singers = $this->artists()->where('role', 'singer')->orderBy('fullname', 'asc')->take(2)->get();
        if (count($singers) > 1) {
            $name = [];
            foreach ($singers as $key => $value) {
                $name[] = $value->fullname;
            }
            return  implode('-', $name);
        } else {
            return $singers->first()->fullname;
        }
    }

    public function url()
    {
        $type = $this->type;
        if ($type == 'music') {
            return route('ShowMusic', $this->slug);
        }
        if ($type == 'podcast') {
            return route('ShowPodcast', $this->slug);
        }
        if ($type == 'video') {
            return route('ShowVideo', $this->slug);
        }
    }

    public function file_url()
    {
        if ($this->files->first()) {

            return 'https://dl.radioavin.com/' . $this->files->first()->url;
        }
        return '#';
    }
    public function check_if_stream()
    {
        
        if ($obj = $this->files->first()) {
            return $obj->status == 2 ? true : false;
        }
        return false;
    }

    public function image($size)
    {
        $data = @unserialize($this->poster);
        // dd($data);
        if ($data == true && unserialize($this->poster)["resize"]) {

            $resize = unserialize($this->poster)["$size"];
            return asset($resize);
        } else {
            if ($size == 'resize') return asset('frontend/images/logo_101.png');
            if ($size == 'banner') return asset('frontend/images/logo_100.png');
        }
    }



    public function relatedPosts()
    {

        $cats =  $this->categories()->pluck('name');
        $type = $this->type;
        $id = $this->id;
        //    if(count($cats)) {
        //        return $posts = static::whereHas('categories',function($q)use($cats){
        //             $q->whereIn('name',$cats);
        //         })->where('type',$type)->where('id','!=',$id)->get();
        //    }else{
        return $posts =  static::whereHas('artists', function ($q) {
            $q->where('fullname', $this->singers());
        })->where('type', $type)->where('id', '!=', $id)->take(10)->get();
        //    }

    }
    public function getReleasedAttribute($value)
    {
        if ($value) {
            return \Carbon\Carbon::parse($value)->format('Y/m/d');
        }
    }

    public function get_type()
    {
        if ($this->type == 'music') {
            return 'MP3';
        }
        if ($this->type == 'podcast') {
            return 'PodCast';
        }
        if ($this->type == 'video') {
            return 'Video';
        }
    }
}
