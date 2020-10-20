<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\Artist;
use App\Category;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostsResource;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\ArtistResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class MainController extends Controller
{
    public function index()
    {
        $categories = Category::has('posts')->orderBy('orders', 'ASC')->get();
        $all = [];
        foreach ($categories as $key => $category) {
            $posts_array = [];
            $posts_array['category'] = $category->name;
            foreach ($category->lastPosts() as $key => $post) {

                $post_array = new PostResource($post);
                $posts_array['posts'][] = $post_array;
            }
            $all[] = $posts_array;
        }

        return Response::json($all, 200);
    }

    public function all()
    {




        $songs = Post::where('type', 'music')->orderBy('title', 'asc')->paginate(30);
        $resource = PostResource::collection($songs);

        return Response::json($resource, 200);
    }

    public function newsongs()
    {
        if (isset(request()->count)) {
            $count = request()->count;
        } else {
            $count = 10;
        }
        $category = Category::where('name', 'New Song')->first();
        $posts = $category->posts()->take($count)->latest()->get();
        return Response::json(PostResource::collection($posts), 200);
    }

    public function hot_tracks()
    {
        if (isset(request()->count)) {
            $count = request()->count;
        } else {
            $count = 10;
        }

        if (Cache::has('hot_tracks')) {
            return Response::json(Cache::get('hot_tracks'), 200);
        }

        $posts = Post::orderBy('views', 'desc')->take($count)->get();
        $json = PostResource::collection($posts);
        Cache::put('hot_tracks', $json, 10);

        return Response::json(PostResource::collection($json), 200);
    }

    public function featured()
    {
        if (isset(request()->count)) {
            $count = request()->count;
        } else {
            $count = 10;
        }
        if (Cache::has('featured')) {
            return Response::json(Cache::get('featured'), 200);
        }

        $category = Category::where('name', 'Featured')->first();
        $posts = $category->posts()->latest()->take($count)->get();
        $json = PostResource::collection($posts);
        Cache::put('featured', $json, 10);
        return Response::json($json, 200);
    }

    public function search(Request $request)
    {
        $word = $request->key;

        if ($word !== null) {
            if (isset($request->q) && $request->q == 'singer') {
                $all = collect(Artist::where('fullname', 'like', '%' . $word . '%')->latest()->take(10)->get());
            } elseif (isset($request->q) && $request->q == 'song') {
                $all = collect(Post::where('title', 'like', '%' . $word . '%')->latest()->take(10)->get());
            } else {
                $posts = collect(Post::where('title', 'like', '%' . $word . '%')->latest()->take(10)->get());
                $artists = collect(Artist::where('fullname', 'like', '%' . $word . '%')->latest()->take(10)->get());
                $all = $posts->merge($artists);
            }
            if (count($all)) {
                foreach ($all as $key => $model) {
                    if ($model instanceof Post) {
                        $post_array = new PostResource($model);

                        $posts_array['posts'][] = $post_array;
                    } else {
                        $post_array = new ArtistResource($model);
                        $posts_array['artists'][] = $post_array;
                    }
                }
            } else {
                $posts_array = [];
            }
        } else {
            $posts_array = [];
        }

        return $posts_array;
    }

    public function get_post($id = null)
    {
        if ($id) {
            $post = Post::find($id);
            if ($post) {

                return Response::json(new PostResource($post), 200);
            } else {
                return Response::json('not found', 404);
            }
        } else {
            return Response::json('not found', 404);
        }
    }

    public function get_artist($id = null)
    {
        if ($id) {
            $artist = Artist::find($id);
            if (!$artist)  return Response::json('artist not found', 404);
            if (Cache::has('get_artist-' . $artist->id)) {

                return Response::json(Cache::get('get_artist-' . $artist->id), 200);
            }
            $top_songs = $artist->top_songs();
            $latest_songs = $artist->latest_songs();
            $latest_videos = $artist->latest_videos(5);
            $data = [
                'artist' => new ArtistResource($artist),
                'top_songs' => PostResource::collection($top_songs),
                'latest_songs' => PostResource::collection($latest_songs),
                'latest_videos' => PostResource::collection($latest_videos),
            ];
            Cache::store()->put('get_artist-' . $artist->id, $data, 100);

            return Response::json($data, 200);
        }
    }
    public function artist_songs($id = null)
    {
        if ($id) {
            $artist = Artist::find($id);
            if (!$artist)  return Response::json('artist not found', 404);
            if (Cache::has('allsong_artist-' . $artist->id)) {

                return Response::json(Cache::get('allsong_artist-' . $artist->id), 200);
            }


            $data = [
                'artist' => new ArtistResource($artist),
                'songs' => PostResource::collection($artist->posts()->where('type', 'music')->latest()->get()),
                'videos' => PostResource::collection($artist->posts()->where('type', 'video')->latest()->get()),
            ];

            Cache::store()->put('allsong_artist-' . $artist->id, $data, 1000);

            return Response::json($data, 200);
        }
    }

    public function AddPlay()
    {
        // dd($request->track_id);
        $ip = $_SERVER['REMOTE_ADDR'];
        $post = Post::find(request()->track_id);
        if (Cache::has("$ip-$post->id")) {
        } else {
            $post = Post::find(request()->track_id);
            $post->increment('views');
            $post->update();
            Cache::store()->put("$ip-$post->id", 'on', 60 * 5);
        }

        return response()->json(new PostResource($post),200);
    }
}
