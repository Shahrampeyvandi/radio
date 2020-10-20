<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Artist;
use App\Slider;
use App\Episode;
use App\Category;
use App\PlayList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MainController extends Controller
{
    public function index()
    {
        
        $categories = Category::has('posts')->orderBy('orders','ASC')->get();
        $playlists = PlayList::getLatest();
        $artists = Artist::where('popular',1)->latest()->get();
        $data['banners'] = Post::has('categories')->latest()->take(2)->get();
        $data['hot_tracks'] = Post::orderBy('views','desc')->take(15)->get();
        $data['categories'] = $categories;
        $data['playlists'] = $playlists;
        $data['playlist_more'] = PlayList::count() > 10 ? true : false;
        $data['artists'] = $artists;
        $data['title'] = 'RadioAvin';
        return view('Front.index', $data);
    }

    public function Play()
    {

        $model = Post::where('slug', request()->slug)->first();
        if (!$model) {
            abort(404);
        }

        if ($model->type == 'movies') {
            $post = $model;
            $videos = $model->videos;

            if (count($videos) == 0) {
                return back();
            }
        }
        if ($model->type == 'series') {
            $season = $model->seasons->where('name', request()->season)->first();
            if (!$season) {
                abort(404);
            }
            $post = $season->sections->where('section', request()->section)->first();
            if (!$post) {
                abort(404);
            }
            $videos = $post->videos;
        }
        return view('Front.play', compact(['videos', 'post']));
    }

    public function DownLoad($id)
    {

       
        $post = Post::find($id);
        $file_name = $post->title . '.mp3';
        $file_url = $post->file_url();
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        readfile($file_url);

        // $tempImage = tempnam(sys_get_temp_dir(), $filename);
        // copy($url, $tempImage);
        // return response()->download($tempImage, $filename);
    }

    public function MyFavorite()
    {
        if (auth()->check()) {

            $myfavorites = auth()->user()->favorite;
        }
        if (auth()->guard('admin')->check()) {
            $myfavorites = auth()->guard('admin')->user()->favorite;
        }
        return view('Front.MyFavorite', compact('myfavorites'));
    }

    public function ShowMore()
    {

        $q = request()->q;
        $type = request()->type;

        if ($q == 'this_month') {
            $data['posts'] = Post::where('type', $type)->whereDate('created_at', '>', Carbon::now()->subMonths(1)->toDateString())
                ->orderBy('created_at', 'DESC')->get();
            $data['title'] = 'RadioAvin | popular this month';
            $data['page_title'] = 'Popular This Month';
        }

        if ($q == 'this_week') {
            $data['posts'] = Post::where('type', $type)->whereDate('created_at', '>', Carbon::now()->subMonths(1)->toDateString())
                ->orderBy('created_at', 'DESC')->get();
            $data['title'] = 'RadioAvin | popular this week';
            $data['page_title'] = 'Popular This Week';
        }

        if ($q == 'all_time') {
            $data['posts'] = Post::where('type', $type)->whereDate('created_at', '>', Carbon::now()->subMonths(1)->toDateString())
                ->orderBy('created_at', 'DESC')->get();
            $data['title'] = 'RadioAvin | popular all time';
            $data['page_title'] = 'Popular All Time';
        }
        if ($q == 'trending') {

            $data['title'] = 'RadioAvin | Trending';
            $data['page_title'] = 'Trending';
            $data['posts'] = Post::where('type',$type)->where('featured', 0)->orderBy('created_at', 'DESC')->get();
        }
        if ($q == 'featured') {
            $data['title'] = 'RadioAvin | Featured';
            $data['page_title'] = 'Featured';
            $data['posts'] = Post::where('type',$type)->where('featured', 1)->orderBy('created_at', 'DESC')->get();
        }



        return view('Front.show-all', $data);
    }
}
