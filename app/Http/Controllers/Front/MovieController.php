<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function Show($slug)
    {
        $post = Post::whereSlug($slug)->first();
        if (is_null($post)) {
            abort(404);
        }
        $title = $post->title;
        $relatedPosts = $post->relatedPosts();
        return view('Front.ShowMovie', ['post' => $post, 'relatedPosts' => $relatedPosts, 'title' => $title]);
    }

    public function All()
    {
        $year = Carbon::now()->year();
        $newmovies = Post::where('type', 'movies')->latest()->take(10)->get();

        $newyear = Post::where(['year' => $year, 'type' => 'movies'])->latest()->take(10)->get();
        $latestdoble = Post::whereHas('categories', function ($q) {
            $q->where('name', 'دوبله فارسی');
        })->where('type', 'movies')->latest()->take(10)->get();

        $sliders = Slider::whereHas('post', function ($q) {
            $q->where('type', 'movies');
        })->latest()->take(5)->get();
        if (count($sliders)) {

            $data['sliders'] = $sliders;
        } else {
            $data['sliders'] = Slider::latest()->take(5)->get();
        }
        $data['newmovies'] = $newmovies;
        $data['latestdoble'] = $latestdoble;
        $data['newyear'] = $newyear;
        $data['year'] = $year;

        return view('Front.AllMovies', $data);
    }
}
