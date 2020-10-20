<?php

namespace App\Http\Controllers\Front;

use App\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VideoController extends Controller
{
    public function Show($slug)
    {

        $post = Post::whereSlug($slug)->first();
        $data['related_posts'] = $post->relatedPosts();
       
        $data['post'] = $post;
        $data['title'] = $slug;
        return view(
            'Front.show-video',
            $data
        );
    }

    public function All()
    {


        $sliders = Post::where('type', 'video')->latest()->take(10)->get();
        $trending = Post::where('type', 'video')->orderBy('views', 'DESC')->get();
        $featured =  Post::where('type', 'video')->where('featured',1)->orderBy('views', 'DESC')->take(24)->get();

        $data['this_week'] = Post::where('type', 'video')->whereDate('created_at', '>', Carbon::now()->subWeeks(1)->toDateString())
            ->orderBy('views', 'DESC')->take(24)->get();
        $data['this_month'] = Post::where('type', 'video')->whereDate('created_at', '>', Carbon::now()->subMonths(1)->toDateString())
            ->orderBy('views', 'DESC')->take(24)->get();
        $data['all_time'] = Post::where('type', 'video')
            ->orderBy('views', 'DESC')->take(24)->get();
       
        $data['sliders'] = $sliders;
        $data['trending'] = $trending;
        $data['featured'] = $featured;


        return view('Front.videos', $data);
    }
}
