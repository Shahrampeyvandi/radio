<?php

namespace App\Http\Controllers\Panel;

use App\Post;

use App\Album;
use App\Image;
use App\Artist;

use App\Category;
use App\PlayList;
use Carbon\Carbon;
use App\File as Fil;
use Image as ImageResize;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Cache;

class MusicController extends Controller
{

    function MusicList(Request $request)
    {
        if(Cache::has('musics')) {
            $musics = Cache::get('musics');
        }else{
            $musics = Post::with(['artists','categories','albums'])->where('type', 'music')->latest()->get();
            Cache::put('musics',$musics,60 * 5);
        }
        return view('Panel.Music.List', compact(['musics']));
    }

    public function Add()
    {

        $playlists = PlayList::all();
        $albums = Album::all();
        $singers = Artist::whereRole('singer')->get();
        $writers = Artist::whereRole('writer')->get();
        return view('Panel.Music.add', compact(['playlists', 'singers', 'writers', 'albums']));
    }



    public function Save(Request $request)
    {




        $this->validation_requests($request);

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        $destinationPath = "music/$slug";

        $post = new Post;
        $post->post_author = 1;
        $post->title = $request->title;
        if ($request->podcast && $request->podcast == 1) {
            $post->type = 'podcast';
        } else {
            $post->type = 'music';
        }

        $post->description = $request->translation;
        if ($request->hasFile('poster')) {
            $Poster = $this->SavePoster($request->file('poster'), 'poster-', $destinationPath);
            $poster161 = $Poster;
            $banner =    $this->image_resize(620, 300, $Poster, $destinationPath);
            // File::delete(public_path() . '/' . $Poster);
            $post->poster = serialize(['resize' => $poster161, 'banner' => $banner]);
        }

        if ($request->released) {
            $post->released = Carbon::parse($request->released)->toDateTimeString();
        }
        $post->duration = $this->get_duration($request->file('file'));
        if ($post->save()) {
            $session = session()->put('temp', $_FILES['file']['tmp_name']);

            $this->saveInformation($request, $post, "audio");
        } else {
            return back();
        }


        return response()->json(
            ['success' => true],
            200
        );

        // return Redirect::route('Panel.MusicList', ['id' => $post->id]);
    }

    public function Edit(Post $post)
    {

        $playlists = PlayList::all();
        $albums = Album::all();
        $singers = Artist::whereRole('singer')->get();
        $writers = Artist::whereRole('writer')->get();
        return view('Panel.Music.add', compact(['post', 'playlists', 'albums', 'singers', 'writers']));
    }






    public function EditMusic(Request $request, Post $post)
    {

        //  dd($request->all());

        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        $destinationPath = "music/$slug";
        if ($request->hasFile('poster')) {
            File::deleteDirectory(public_path("music/$post->slug"));
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true);
            }
            $Poster = $this->SavePoster($request->file('poster'), 'poster-', $destinationPath);
            $poster161 =  $Poster;
            $banner =    $this->image_resize(620, 300, $Poster, $destinationPath);
            // File::delete(public_path() . '/' . $Poster);
            $serialized = serialize(['resize' => $poster161, 'banner' => $banner]);
        } else {
            $serialized = $post->poster;
        }

        $post->post_author = 1;
        $post->title = $request->title;
        $post->description = $request->translation;
        $post->released = Carbon::parse($request->released)->toDateTimeString();
        $post->poster = $serialized;


        $post->update();


        if (isset($request->file)) {
            $session = session()->put('temp', $_FILES['file']['tmp_name']);
        }
        $this->editInformation($request, $post, "audio");

        return response()->json(
            ['success' => true],
            200
        );
        // toastr()->success('موزیک با موفقیت ویرایش شد');

        // return Redirect::route('Panel.MusicList');
    }

    public function DeletePost(Request $request)
    {

        
        $post = Post::find($request->post_id);
        // dd($post);
        if ($post->type == 'video') {
            File::deleteDirectory(public_path("videos/$post->slug/"));
        } else {
            File::deleteDirectory(public_path("music/$post->slug/"));
        }
        foreach ($post->files as $key => $file) {
            $this->delete_with_ftp($file->url);
        }

        $post->files()->delete();
        $post->captions()->delete();

        $post->delete();

        toastr()->success('پست با موفقیت حذف شد');
        return back();
    }

    public function DeleteVideo(Request $request)
    {

        $video = Video::find($request->id);
        File::delete(public_path() . $video->url);
        foreach ($video->captions as $key => $caption) {
            $caption->delete();
        }
        $video->delete();
        return response()->json('ویدیو با موفقیت حذف شد');
    }

    public function DeleteImage(Request $request)
    {
        $image = Image::find($request->id);
        File::delete(public_path() . $image->url);
        $image->delete();
        return response()->json('تصویر با موفقیت حذف شد');
    }


    public function AddCatAjax(Request $request)
    {

        $cat = new Category;
        $cat->name = $request->name;
        $cat->save();

        return response()->json([
            'id' => $cat->id,
            'name' => $cat->name
        ], 200);
    }


    public function checkNameAjax(Request $request)
    {
        // check in db
        if (Post::where('name', $request->name)->count()) {
            return response()->json(['error' => 'این مورد از قبل ثبت شده است']);
        }
    }

    public function FilterPosts(Request $request)
    {
        if($request->cat !== null && $request->singer !== null) {

            $musics = Post::with(['artists','categories','albums'])->where('type', 'music')->whereHas('categories',function($q)use($request){
                $q->whereId($request->cat);
            })->whereHas('artists',function($q)use($request){
                $q->whereId($request->singer);
            })->latest()->get();
        }

         if($request->cat !== null && $request->singer == null) {

            $musics = Post::with(['artists','categories','albums'])->where('type', 'music')->whereHas('categories',function($q)use($request){
                $q->whereId($request->cat);
            })->latest()->get();
        }

         if($request->cat == null && $request->singer !== null) {

            $musics = Post::with(['artists','categories','albums'])->where('type', 'music')->whereHas('artists',function($q)use($request){
                $q->whereId($request->singer);
            })->latest()->get();
        }

          if($request->cat == null && $request->singer == null) {

            $musics = Post::with(['artists','categories','albums'])->where('type', 'music')->latest()->get();
        }

       
        return view('Panel.Music.List', compact(['musics']));
    }
}
