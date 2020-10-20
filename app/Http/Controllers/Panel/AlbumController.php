<?php

namespace App\Http\Controllers\Panel;

use App\Post;
use App\Album;
use App\Artist;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AlbumController extends Controller
{
    public $destinationPath = 'album_images';
    public function List()
    {
        $albums = Album::latest()->get();
        return view('Panel.Album.List', ['albums' => $albums]);
    }

    public function Add()
    {
        $songs = Post::whereType('music')->orderBy('title', 'DESC')->get();
        return view('Panel.Album.Add', ['songs' => $songs]);
    }

    public function Save(Request $request)
    {


        $slug = SlugService::createSlug(Album::class, 'slug', $request->name);
        if (request()->hasFile('poster')) {
            $poster = $this->SavePoster($request->file('poster'), $slug, $this->destinationPath);
            $resize = $this->image_resize(179, 179, $poster, $this->destinationPath);
            File::delete(public_path() . '/' . $poster);
        } else {
            $resize = '';
        }
        $album = new Album();
        $album->name = $request->name;
        $album->information = $request->information;
        $album->image = $resize;
        $album->save();

        if (isset($request->songs)) {
            foreach ($request->songs as $key => $song) {
                $album->posts()->attach($song);
            }
        }

         if (isset($request->singers)) {
            foreach ($request->singers as $key => $singer) {
                $album->singers()->attach($singer);
            }
        }

        toastr()->success('album added successfuly');

        return Redirect::route('Panel.Album');
    }
    public function Edit(Album $album)
    {

        return view('Panel.Album.Add', compact(['album']));
    }

    public function EditSave(Request $request, $id)
    {
         $album = Album::find($id);
        $slug = Str::slug($request->name);

        if ($request->hasFile('poster')) {
            File::delete(public_path() . $album->image);

            if (!File::exists($this->destinationPath)) {
                File::makeDirectory($this->destinationPath, 0777, true);
            }
            $poster = $this->SavePoster($request->file('poster'), $slug, $this->destinationPath);
            $resize = $this->image_resize(179, 179, $poster, $this->destinationPath);
            File::delete(public_path() . '/' . $poster);
        } else {
            $resize = $album->image;
        }

        $album->name = $request->name;
        $album->information = $request->information;
        $album->image = $resize;
        $album->update();

        
        $album->posts()->detach();
          if (isset($request->songs)) {
            foreach ($request->songs as $key => $song) {
                $album->posts()->attach($song);
            }
        }

        $album->singers()->detach();
         if (isset($request->singers)) {
            foreach ($request->singers as $key => $singer) {
                $album->singers()->attach($singer);
            }
        }

        toastr()->success('آلبوم با موفقیت ویرایش شد');

        return Redirect::route('Panel.Album');
    }

      public function Delete(Request $request)
    {


        $album = Album::find($request->id);
        
        File::delete(public_path() . '/' . $album->image);

        $album->posts()->detach();
        $album->singers()->detach();

        $album->delete();

        toastr()->success('Album Delete Successfully');
        return back();
    }
}
