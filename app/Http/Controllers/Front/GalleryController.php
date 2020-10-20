<?php

namespace App\Http\Controllers\Front;

use App\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
     public function All()
    {
        $data['title'] = 'Radio Avin | Photos';
        $data['sliders'] = Gallery::latest()->take(6)->get();
        $data['galleries'] = Gallery::with('images')->latest()->get();

        return view('Front.photogalleries',$data);

    }
    public function Show($slug)
    {
        
         $data['title'] = 'Radio Avin | '.$slug.'';
         $data['gallery'] = Gallery::whereSlug($slug)->with('images')->first();
         return view('Front.show-gallery',$data);

    }
}
