<?php

namespace App\Http\Controllers\Front;

use App\Post;
use App\Slider;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function All()
    {
        $categories = Category::has('posts')->get();
       
        return view('Front.Categories', ['categories' => $categories]);
    }

    public function Show(Request $request, $name)
    {
        $category = Category::where('name', $name)->first();
        if ($category) {
            $data['posts'] = $category->posts()->latest()->get();
            $data['title'] = 'RadioAvin | ' . $category->name;
            $data['page_title'] = ucfirst($category->name);
         
            return view('Front.show-all', $data);
        } else {
            abort(404);
        }
    }
}
