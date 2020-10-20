<?php

namespace App\Http\Controllers\Front;

use App\Plan;
use App\Post;
use App\Vote;
use App\Artist;
use UplaylistTrack;
use App\UserPlaylist;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Response;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class AjaxController extends Controller
{
    public function getMovieDetail(Request $request)
    {

        $post = Post::find($request->id);

        if ($post) {
            if ($post->type == 'movies') {
                return response()->json([
                    'id' => $post->id,
                    'type' => 'movies',
                    'poster' => asset($post->poster),
                    'title' => $post->title,
                    'desc' => Str::limit($post->description, 200, '...'),
                    'path' => $post->path(),
                    'play' => $post->play(),
                    'download' => $post->downloadpath(),
                    'favoritepath' => $post->favoritepath(),
                    'favoritestatus' => $post->checkFavorite($post->id)
                ], 200);
            }
            if ($post->type == 'series') {
                return response()->json([
                    'id' => $post->id,
                    'type' => 'series',
                    'poster' => asset($post->poster),
                    'title' => $post->title,
                    'desc' => Str::limit($post->description, 200, '...'),
                    'path' => $post->path(),
                    'favoritepath' => $post->favoritepath(),
                    'favoritestatus' => $post->checkFavorite()
                ], 200);
            }
        }
    }


    public function addToFavorite(Request $request)
    {
        // dd($request->all());

        if (auth()->check()) {
            $user = auth()->user();
        } else {
            return response()->json(['auth' => false, 'login' => route('login')], 200);
        }



        $obj = DB::table('user_favorite')->where(['user_id' => $user->id, 'post_id' => $request->post_id])->first();
        if ($obj) {
            $user->favorite()->detach($request->post_id);
            return response()->json('detach', 200);
        } else {
            $user->favorite()->attach($request->post_id);
            return response()->json('attach', 200);
        }
    }

    public function getPlaylists(Request $request)
    {

        if (!auth()->check()) {
            return 'You must  <a href="' . route('login') . '" class="text-gray">login </a> to add to playlist.';
        }
        $track = $request->id;
        $user_id = auth()->user()->id;
        $request->session()->put("track_id", $request->id);
        $user_playlists = auth()->user()->playlists->where('type', $request->type);

        $url = route('Ajax.NewPlaylist');

        $list  = '<div class="pl-wrapper">';
        foreach ($user_playlists as $key => $playlist) {
            if ($playlist->tracks->contains($track)) {
                $icon = '<i class="fa fa-minus"></i>';
            } else {
                $icon = '<i class="fa fa-plus"></i>';
            }
            $list .= ' <div class="pl-item"><a href="' . $playlist->playurl() . '" class="user-playlist">' . $playlist->name . ' (' . count($playlist->tracks) . ') </a>
        <div class="ml-2">
            <a href="#" class="add" data-id="' . $playlist->id . '" onclick="addToPlaylist(event,'.$playlist->id.')" > ' . $icon . ' </a>
            <a href="'.route('Play.EditPlaylist',$playlist->id).'" target="_blank" onclick=""> <i class="fa fa-edit"></i> </a>
            <a href="#" class="ml-1" onclick="deletePlaylist(event,'.$playlist->id.')"> <i class="fa fa-trash"></i> </a>
        </div>
        </div>';
        }

        $list .= '
       </div>
       <hr/>
       <a  href="#" class="newplaylist" data-type="' . $request->type . '" onclick="showForm(event)">New Playlist</a>
       ';
        return $list;
    }

    public function newPlaylist(Request $request)
    {

        if(UserPlaylist::whereName($request->name)->count()) {
            return response()->json(['error'=>'playlist exist'],200);
        }
    
        $playlist = UserPlaylist::create([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
            'type' => $request->type
        ]);
        return response()->json([
            'name' => $playlist->name,
            'id' => $playlist->id,
            'playurl' => $playlist->playurl(),
            'addurl' => $playlist->addurl()

        ], 200);
    }

    public function addToPlaylist(Request $request)
    {

       

        $track = $request->session()->get('track_id');


        $playlist = UserPlaylist::find($request->playlist_id);
        if ($playlist->tracks->contains($track)) {
            $playlist->tracks()->detach($track);
            $status = 'detach';
        } else {
            $playlist->tracks()->attach($track);
            $status = 'attach';
        }

        return response()->json($status, 200);
    }


    public function checkTakhfif(Request $request)
    {
        $user = auth()->user();


        $plan = Plan::whereId($request->plan_id)->first();
        if ($plan) {
            $discount = $plan->discounts->where('d_code', $request->code);

            if (count($discount)) {

                $amount = ($plan->priceWithDiscount() * $discount->first()->percent) / 100;
                session()->put('discount' . $user->id, $amount);
                session()->put('amount' . $user->id, $plan->priceWithDiscount() - $amount);
                return response()->json(session()->get('amount' . $user->id), 200);
            }
        }
    }



    public function Search(Request $request)
    {

        $cat = [];
        $caption = [];
        $year = [];
        // dd($request->all());

        $word = $request->word;
        if ($word !== null) {
            $posts = collect(Post::where('title', 'like', '%' . $word . '%')->latest()->take(10)->get());
            $artists = collect(Artist::where('fullname', 'like', '%' . $word . '%')->latest()->take(10)->get());
            $all = $posts->merge($artists);
        } else {
        }

        $articles = $this->createArticles($all);

        return response()->json($articles, 200);
    }

    public function createArticles($all)
    {
        $article = '';
        foreach ($all as $key => $obj) {
            if ($key % 2 == 0) {
                $color = 'ac_even';
            } else {
                $color = 'ac_odd';
            }
            if ($obj instanceof Post) {
                $article .= '  <li class="' . $color . '">
                                  <a href="' . $obj->url() . '">
                                    <div class="image_crop"><img
                                            src="' . asset(unserialize($obj->poster)['resize']) . '">
                                    </div>
                                    <div class="text">
                                    ' . Str::limit($obj->title, 20, '...') . '
                                    </div> <span
                                        class="label">' . $obj->get_type() . '</span>
                                   </a>
                                </li>';
            } else {
                $article .= ' <li class="' . $color . '">
                                   <a href="' . $obj->url() . '">
                                        <div class="image_crop"><img
                                            src="' . asset(unserialize($obj->photo)['resize']) . '">
                                    </div>
                                    <div class="text">' . Str::limit($obj->fullname, 20, '') . '</div> <span
                                        class="label">Artist</span>
                                   </a>
                                </li>';
            }
        }
        return $article;
    }

    public function LikePost()
    {
        if (Auth::check()) {
            $id = request()->post_id;
            $post = Post::whereId($id)->first();
           
            if (count($post->votes->where('user_id', Auth::user()->id)) == 0) {

                Vote::create([
                    'votable_id' => request()->post_id,
                    'votable_type' => 'App\Post',
                    'user_id' => auth()->user()->id,
                    'status' => 1
                ]);

                return response()->json(['error'=>false,'likes' => count($post->votes), 'status' => true], 200);
            } else {
                return response()->json(['error'=>false,'likes' => count($post->votes), 'status' => false], 200);
            }
        } else {
            return response()->json(['error' => true,'status'=>false], 200);
        }
    }

    public function DownLoad()
    {
        $id = request()->id;
        $post = Post::find($id);
        $file_name = 'file.mp3';
        $file_url = $post->file_url();
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        readfile($file_url);
    }

    public function AddPlay(Request $request)
    {
        // dd($request->track_id);
        $ip = $_SERVER['REMOTE_ADDR'];
        $post = Post::find($request->track_id);

       
       
       
        if(Cache::has("$ip-$post->id")) {
           
        }else{
            $post = Post::find($request->track_id);
            $post->increment('views');
            $post->update();
             Cache::store()->put("$ip-$post->id",'on', 60 * 5);
            
        }
        
    }

    public function DeletePlaylist(Request $request)
    {
       $playlist = UserPlaylist::find($request->playlist_id);
        $playlist->tracks()->detach();
        $playlist->delete();
        return response()->json('success');
    }
}
