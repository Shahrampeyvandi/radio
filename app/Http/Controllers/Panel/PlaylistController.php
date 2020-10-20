<?php

namespace App\Http\Controllers\Panel;

use App\Post;
use App\PlayList;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class PlaylistController extends Controller
{
    public $destinationPath = "playlist_images";
    public function List()
    {
        $playlists = PlayList::latest()->get();
        return view('Panel.PlayList.List', ['playlists' => $playlists]);
    }

    public function Add()
    {
        $songs = Post::whereType('music')->orderBy('title', 'DESC')->get();
        return view('Panel.PlayList.Add', ['songs' => $songs]);
    }

    public function Save(Request $request)
    {
        $slug = Str::slug($request->name);
        if (request()->hasFile('poster')) {
            $poster = $this->SavePoster($request->file('poster'), $slug, "$this->destinationPath/$slug");
            $resize = $this->image_resize(179, 179, $poster, "$this->destinationPath/$slug");
            File::delete(public_path() . '/' . $poster);
        } else {
            $resize = '';
        }


        $playlist = new PlayList();
        $playlist->name = $request->name;
        $playlist->information = $request->information;
        $playlist->image = $resize;
        $playlist->save();

        if (isset($request->songs)) {
            foreach ($request->songs as $key => $song) {
                $playlist->tracks()->attach($song);
            }
        }

        toastr()->success('playlist added successfuly');

        return Redirect::route('Panel.PlayList');
    }
    public function Edit($id)
    {
        $playlist = PlayList::find($id);
        return view('Panel.PlayList.Add', compact(['playlist']));
    }

    public function EditSave(Request $request, $id)
    {
       
        $playlist = PlayList::find($id);
        $slug = Str::slug($request->name);

        if ($request->hasFile('poster')) {
            File::delete(public_path() . $playlist->image);

            if (!File::exists("$this->destinationPath/$slug")) {
                File::makeDirectory("$this->destinationPath/$slug", 0777, true);
            }
            $poster = $this->SavePoster($request->file('poster'), $slug, "$this->destinationPath/$slug");
            $resize = $this->image_resize(179, 179, $poster, "$this->destinationPath/$slug");
            File::delete(public_path() . '/' . $poster);
        } else {
            $resize = $playlist->image;
        }

        $playlist->name = $request->name;
        $playlist->information = $request->information;
        $playlist->image = $resize;
        $playlist->update();

        toastr()->success('پلی لیست با موفقیت ویرایش شد');

        return Redirect::route('Panel.PlayList');
    }

    public function Delete(Request $request)
    {


        $playlist = PlayList::find($request->id);
        $slug = Str::slug($playlist->name);
        File::deleteDirectory(public_path("$this->destinationPath/$slug"));

        $playlist->tracks()->detach();

        $playlist->delete();

        toastr()->success('پلی لیست با موفقیت حذف شد');
        return back();
    }

    public function ChangeFeatured(Request $request)
    {


        $playlist = PlayList::find($request->id);
        if ($playlist->featured == 1) {
            $playlist->featured = 0;
        } else {
            $playlist->featured = 1;
        }
        $playlist->save();

        return response()->json([
            'data' => $playlist->featured

        ]);
        toastr()->success('پلی لیست با موفقیت حذف شد');
        return back();
    }
}
