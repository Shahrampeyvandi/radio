<?php

namespace App\Http\Controllers\Panel;

use App\Actor;
use App\Category;
use App\Director;
use App\Http\Controllers\Controller;
use App\Language;
use App\Post;
use App\Writer;
use Goutte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class ImdbController extends Controller
{

    public function AddMovie()
    {

        $actors = Actor::all();
        $writers = Writer::all();
        $directors = Director::all();
        $languages = Language::all();

        return view('Panel.Movies.add', compact(['writers', 'directors', 'actors', 'languages']));
    }

   

    public function testApi()
    {

//           $crawler = Goutte::request('GET', 'https://help.imdb.com/article/contribution/titles/genres/GZDRMS6R742JRGAG#');
//         $crawler->filter('p:nth-of-type(1) a')->each(function ($node) {
            
//             DB::table('categories')->insert([
//                 'name' =>'a',
//                 'latin' => $node->text(),
               
//             ]);

//         });


// dd('sdf');

        $actor = \L5Imdb::searchPerson('daniel Radcliffe')->all()[0];
        dd($actor);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://imdb8.p.rapidapi.com/title/get-top-cast?tconst=tt0944947",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-rapidapi-host: imdb8.p.rapidapi.com",
                "x-rapidapi-key: SIGN-UP-FOR-KEY",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
        dd($response);

      
    }
    public function Get(Request $request)
    {


        // check in db
        if(Post::where('imdbID',$request->code)->count()){
            return response()->json(['error'=>'این مورد از قبل ثبت شده است']
          
        );
        }

        $array = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://www.omdbapi.com/?i=' . $request->code . '&apikey=72a95dff');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $result = json_decode($response);
        curl_close($ch); // Close the connection
        // dd($result);
        if ($result->Writer) {
            $writers = \explode(',', $result->Writer);
           foreach ($writers as $key => $item) {
                $item = trim(preg_replace('/\s*\([^)]*\)/', '', $item));
               $check= Writer::whereName($item)->first();
               if($check) {
                   $array['writers'][] = ['name'=>$item,'src'=>$check->image];
               }else{
                    $array['writers'][] = ['name'=>$item,'src'=>''];
               }
            }
        }else{
            $array['writers'][] = '';
        }
        if ($result->Director) {
            $directors = \explode(',', $result->Director);
            foreach ($directors as $key => $item) {
                $item = trim(preg_replace('/\s*\([^)]*\)/', '', $item));
               $check= Director::whereName($item)->first();
               if($check) {
                   $array['directors'][] = ['name'=>$item,'src'=>$check->image];
               }else{
                    $array['directors'][] = ['name'=>$item,'src'=>''];
               }
            }
        }else{
            $array['directors'][] = '';
        }
        $array['released'] = $result->Released;
        $array['imdbRating'] = $result->imdbRating;
        $array['imdbID'] = $result->imdbID;
        $array['imdbVotes'] = $result->imdbVotes;
        $array['Awards'] = $result->Awards;
       
        $array['Released'] = $result->Released;

        $dd = \L5Imdb::title($request->code)->all();
     
        $array['is_serial'] = $dd['is_serial'] ? 'series' : 'movies';
        if($dd['is_serial']) {
            $array['seasons'] = $dd['seasons'];
        }else{
             $array['seasons'] = null;
        }
        $latin_cats = $dd['genres'];
        $array['runtime'] = $dd['runtime'];
        $array['title'] = $dd['title'];
        $array['year'] = $dd['year'];
        $array['storyline'] = $dd['storyline'];
        $array['runtime'] = $dd['runtime'];
        $array['photoThumb'] = $dd['photoThumb'];
        $array['photo'] = $dd['photo'];
         $array['languages'] = $dd['languages'];   
         $cat_list = '';
        
        foreach ($latin_cats as $key => $category) {
            $model = Category::whereLatin($category)->first();
            if ($model) {
                $cat_list .= ' <div class="custom-control custom-checkbox custom-control-inline ">
                <input type="checkbox" id="cat-'.($key+1).'" name="categories[]" value="'.$model->latin.'" class="custom-control-input scat" checked>
                <label class="custom-control-label" for="cat-'.($key+1).'">'.$model->name.'</label>
            </div>';
            }
        }

        $array['catlist'] = $cat_list;

        foreach ($dd['cast'] as $key => $cast) {
            $array['casts'][] = [$cast['name'], $cast['photo']];
        }

        foreach ($dd['mainPictures'] as $key => $image) {
            $array['mainPictures'][] = $image['imgsrc'];
        }
        
        return response()->json($array, 200);


    }
}
