<?php

namespace App\Http\Controllers\Panel;

use App\Category;
use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function Show()
    {
        $data['categories'] = Category::latest()->get();
        return view('Panel.Setting.Show',$data);
    }

    public function Save(Request $request)
    {
        
        foreach ($request->cat as $key => $item) {
            if(\array_key_exists('name',$item)) {
                Category::whereName($item['name'])->update(['orders'=>$item['order']]);
            }
        }

        return back();
        
    }
}
