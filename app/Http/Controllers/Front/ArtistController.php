<?php

namespace App\Http\Controllers\Front;

use App\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{
    public function Show($slug)
    {
        $data['artist'] = Artist::whereSlug($slug)->first();
        if(!$data['artist']) abort(404);
        $data['title'] = 'RadioAvin | ' . $data['artist']->fullname;
        $data['mp3s'] = $data['artist']->posts()->where('type','music')->latest()->take(10)->get();
        $data['albums'] = $data['artist']->albums()->orderBy('name','asc')->take(10)->get();
        $data['videos'] = $data['artist']->posts()->where('type','video')->latest()->take(10)->get();
      
        return view('Front.show-artist',$data);
    }

    public function Filter()
    {
        if (!isset(request()->q)) {
            abort(404);
        }
        $q = request()->q;
       
        
        $data['singers'] = Artist::whereRole('singer')->where('fullname', 'like', $q . '%')->get();
        $data['q'] = $q;

        return view('Front.show-filter',$data);




    }
}
