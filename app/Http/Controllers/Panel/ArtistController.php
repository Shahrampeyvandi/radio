<?php

namespace App\Http\Controllers\Panel;

use App\Artist;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ArtistController extends Controller
{
    public $destinationPath = 'artist_image';
    public function List()
    {
        $artists = Artist::latest()->get();
        return view('Panel.Artist.List', ['artists' => $artists]);
    }

    public function Add()
    {
        return view('Panel.Artist.Add');
    }

    public function Save(Request $request)
    {

        

        $slug = SlugService::createSlug(Artist::class, 'slug', $request->name);
        if (request()->hasFile('poster')) {
            $Poster = $this->SavePoster($request->file('poster'), 'poster-', "$this->destinationPath/$slug");
            $resize =  $this->image_resize(600, 600, $Poster, "$this->destinationPath/$slug");




            $poster = serialize(['resize' => $resize, 'banner' => $Poster]);
        } else {
            $poster = '';
        }
        $artist = new Artist();
        $artist->fullname = $request->name;
        $artist->role = $request->role;
        $artist->bio = $request->bio;
       if ($request->birthday) {
            $artist->birthday = Carbon::parse($request->birthday)->toDateTimeString();
       }else{
           $artist->birthday = null;
       }
        $artist->photo = $poster;
        if(isset($request->popular) && $request->popular == 1) {
            $artist->popular= $request->popular;
        }
        $artist->save();

        toastr()->success('هنرمند با موفقیت ثبت شد');

        return Redirect::route('Panel.ArtistList');
    }
    public function Edit(Artist $artist)
    {

        return view('Panel.Artist.Add', compact(['artist']));
    }

    public function EditSave(Request $request, Artist $artist)
    {

        

        
        if ($request->hasFile('poster')) {
            File::deleteDirectory(public_path("$this->destinationPath/$artist->slug"));

            if (!File::exists($this->destinationPath)) {
                File::makeDirectory($this->destinationPath, 0777, true);
            }
            $Poster = $this->SavePoster($request->file('poster'), 'poster-', "$this->destinationPath/$artist->slug");
            $resize =  $this->image_resize(600, 600, $Poster, "$this->destinationPath/$artist->slug");
            $poster = serialize(['resize' => $resize, 'banner' => $Poster]);
        } else {
            $poster = $artist->photo;
        }

        $artist->fullname = $request->name;
        $artist->role = $request->role;
        $artist->bio = $request->bio;
        if (!is_null($request->birthday)) {
            $artist->birthday = Carbon::parse($request->birthday)->toDateTimeString();
       }else{
           $artist->birthday = null;
       }
        $artist->photo = $poster;
          if(isset($request->popular) && $request->popular == 1) {
            $artist->popular= $request->popular;
        }else{
            $artist->popular= 0 ;
        }
        $artist->update();

        toastr()->success('هنرمند با موفقیت ویرایش شد');

        return Redirect::route('Panel.ArtistList');
    }

    public function Delete(Request $request)
    {

        $artist = Artist::find($request->id);
        File::deleteDirectory(public_path("$this->destinationPath/$artist->slug"));

        $artist->posts()->detach();

        $artist->delete();

        toastr()->success('هنرمند با موفقیت حذف شد');
        return back();
    }
}
