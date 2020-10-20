<?php

namespace App\Http\Controllers\Front;

use App\Album;
use App\Post;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;

class MusicController extends Controller
{
    public function Show($slug)
    {

        $post = collect(Post::whereSlug($slug)->get());
        if (empty($post)) {
            abort(404);
        }
        $relatedPosts = collect($post->first()->relatedPosts());

        $all = $post->merge($relatedPosts);

        $title = $post->first()->title;
        $data['post'] = $post->first();
        $data['relatedPosts'] = $relatedPosts;
        $data['title'] = 'RadioAvin | '. $title;
        $data['type'] = $post->first()->type;
        $array = [];
        foreach ($all as $key => $item) {

            $array[] = [
                'id' => $item->id,
                'name' => $item->title,
                'artist' => $item->singers(),
                'image' => $item->image('resize'),
                'path' => $item->file_url(),
                'lyric' => $item->description,
                'likes' => count($item->votes),
                'views' => $item->views,
                'released' => $item->released
            ];
        }
        
        
        

        $data['track_lists'] = json_encode($array);

        return view(
            'Front.show-music',
            $data
        );
    }

    public function All()
    {

       
        $sliders = Post::where('type', 'music')->orderBy('created_at', 'desc')->take(10)->get();

        $featured = Post::where('type', 'music')->whereHas('categories',function($q){
            $q->where('name','Featured');
        })->orderBy('created_at', 'desc')->take(29)->get();
        $trending = Post::where('type', 'music')->withCount('votes')->orderBy('votes_count','desc')->take(29)->get();
        

        $data['this_week'] = Post::where('type', 'music')->
        whereDate('created_at', '>', Carbon::now()->subWeeks(1)->toDateString())
        ->orderBy('created_at', 'desc')->take(8)->get();
        $data['this_month'] = Post::where('type', 'music')->
        whereDate('created_at', '>', Carbon::now()->subMonths(1)->toDateString())
        ->orderBy('created_at', 'desc')->take(8)->get();
        $data['all_time'] = Post::where('type', 'music')
        ->orderBy('created_at', 'desc')->take(8)->get();

        $data['albums'] = Album::has('posts')->orderBy('created_at', 'desc')->get();
        $data['sliders'] = $sliders;
        $data['trending'] = $trending;
        $data['featured'] = $featured;


        return view('Front.mp3s', $data);
    }
}
