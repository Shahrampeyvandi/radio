<?php

namespace App\Http\Controllers\Panel;

use App\Actor;
use App\Director;
use App\Http\Controllers\Controller;
use App\Writer;
use Illuminate\Http\Request;

class ActorsController extends Controller
{

    private function upload($destinationPath)
    {
        if (request()->hasFile('picture')) {
            $picextension = request()->file('picture')->getClientOriginalExtension();
            $fileName = 'picture' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            request()->file('picture')->move($destinationPath, $fileName);
            return "$destinationPath/$fileName";
        } else {
            return '';
        }
    }
    public function Insert(Request $request)
    {
        if ($request->type == "actor") {
            $destinationPath = "files/actors";

            $image = $this->upload($destinationPath);

            Actor::create([
                'name' => $request->fullname,
                'image' => $image,
                'bio' => $request->description,
            ]);
        }

        if ($request->type == "writer") {
            $destinationPath = "files/writers";

            $image = $this->upload($destinationPath);
            Writer::create([
                'name' => $request->fullname,
                'image' => $image,
                'bio' => $request->description,
            ]);
        }
         if ($request->type == "creator") {
            $destinationPath = "files/directors";

            $image = $this->upload($destinationPath);
            Director::create([
                'name' => $request->fullname,
                'image' => $image,
                'bio' => $request->description,
            ]);
        }

        return back();
    }

    public function GetActorAjax(Request $request)
    {
        
        $actors = Actor::where("name", "like", "%" . $request->val . "%")->get();
        $list = '';
        foreach ($actors as $key => $actor) {
            $list .= '<li><a href="#" onclick="addToInput(event)">'.$actor->name.'</a></li>';
        }

        return $list;
    }
      public function GetDirectorAjax(Request $request)
    {
        
        $actors = Director::where("name", "like", "%" . $request->val . "%")->get();
        $list = '';
        foreach ($actors as $key => $actor) {
            $list .= '<li><a href="#" onclick="addToInput(event)">'.$actor->name.'</a></li>';
        }

        return $list;
    }
}
