<?php

namespace App\Http\Controllers;

use Image;
use App\Tag;
use App\User;
use App\Album;
use App\Lyric;
use App\Artist;
use App\Category;
use App\PlayList;
use App\Arrangement;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\IsFalse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function token($token)
    {

        $payload = JWTAuth::parseToken($token)->getPayload();
        $email = $payload->get('email');
        $member = User::where('email', $email)->first();
        return $member;
    }
    public function convertDate($date)
    {

        $date_array = explode('/', $date);
        $year = $date_array[2];
        $month = $date_array[1];
        $day = $date_array[0];
        if (strlen($month) == 1) {
            $month = '0' . $month;
        }
        if (strlen($day) == 1) {
            $day = '0' . $day;
        }


        $new_date_array = array($year, $month, $day);
        $new_date_string = implode('/', $new_date_array);
        $carbon = \Morilog\Jalali\CalendarUtils::createCarbonFromFormat('Y/m/d', $new_date_string);

        return $carbon;
    }

    public function saveInformation(Request $request, $post, $destinationPath)
    {
        if (isset($request->singers)) {
            foreach ($request->singers as $key => $singer) {
                if ($id = Artist::check($singer)) {
                    $post->artists()->attach($id);
                }
            }
        }

        if ($post->type == 'video') {
            if (isset($request->file)) {
                foreach ($request->file as $key => $video) {

                    if (!is_null($video[1])) {
                        if (!File::exists($destinationPath)) {
                            File::makeDirectory($destinationPath, 0777, true);
                        }
                        $picextension = $video[1]->getClientOriginalExtension();
                        $fileName = 'video_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
                        $session = session()->put('temp', $video[1]->getPathName());
                        $status =  $this->upload_with_ftp($fileName, "video");
                        if (!$status) abort(404);

                        $videoPath = "$destinationPath/$fileName";
                        $post->files()->create(['url' => $videoPath, 'type' => 'video', 'quality_id' => $video[2]]);
                    }
                }
            }
            if (isset($request->captions)) {
                foreach ($request->captions as $key => $caption) {
                    if (!is_null($caption[1]) && isset($caption[2]) && !is_null($caption[2])) {

                        $picextension = $caption[2]->getClientOriginalExtension();
                        $fileName = 'caption_' . $key . date("Y-m-d") . '_' . time() . '.' . $picextension;
                        $session = session()->put('temp', $caption[2]->getPathName());
                        $captionPath = "$destinationPath/$fileName";
                        $post->captions()->create(['url' => $captionPath, 'lang' => $caption[1]]);
                    }
                }
            }
        }


        if ($post->type !== 'video') {
            if (isset($request->playLists)) {
                foreach ($request->playlists as $key => $playlist) {
                    if ($id = PlayList::check($playlist)) {
                        $post->playlists()->attach($id);
                    }
                }
            }
            if (isset($request->writers)) {
                foreach ($request->writers as $key => $writer) {
                    if ($id = Artist::check($writer)) {
                        $post->artists()->attach($id);
                    }
                }
            }
            if (isset($request->arrangements)) {
                foreach ($request->arrangements as $key => $arrangement) {
                    if ($id = Arrangement::check($arrangement)) {
                        $post->arrangements()->attach($id);
                    } else {

                        $post->arrangements()->create(['name' => $arrangement]);
                    }
                }
            }
            if (isset($request->albums)) {
                foreach ($request->albums as $key => $album) {

                    $post->albums()->attach($album);
                }
            }
            if (isset($request->category) && $request->category !== null) {

                if ($id = Category::check($request->category)) {
                    $post->categories()->attach($id);
                }
            }

            if ($request->has('file')) {
                $picextension = $request->file('file')->getClientOriginalExtension();
                $fileName = 'audio_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
                $status =  $this->upload_with_ftp($fileName, $destinationPath);
                if (!$status) abort(404);
                $post->files()->create(['url' => "$destinationPath/$fileName", 'type' => 'audio']);
            }
        }
    }



    public function validation_requests(Request $request)
    {

        $getID3 = new \getID3;
        $filedur = $getID3->analyze($request->file('file'));

        if (array_key_exists('error', $filedur) && count($filedur['error'])) {
            return response()->json(
                [
                    'errors' => "format is incorrect"
                ],
                403

            );
        }

        $validator = Validator::make($request->all(), [
            'file' => 'mimes:mp3,mp4|required',
            'pic' => 'nullable|mimes:jpeg,png,jpg',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->errors()->first()

            ), 400); // 400 being the HTTP code for an invalid request.
        }
    }

    public function editInformation(Request $request, $post, $destinationPath)
    {


        if ($post->type == 'video') {
            if (isset($request->file)) {
                foreach ($request->file as $key => $video) {
                    if (array_key_exists(1, $video) && !is_null($video[1])) {


                        $picextension = $video[1]->getClientOriginalExtension();
                        $fileName = 'video_' . $key . date("Y-m-d") . '_' . time() . '.' . $picextension;
                        $session = session()->put('temp', $video[1]->getPathName());
                        $status =  $this->upload_with_ftp($fileName, "video");
                        if (!$status) abort(404);

                        $videoPath = "$destinationPath/$fileName";
                        $post->files()->create(['url' => $videoPath, 'type' => 'video', 'quality_id' => $video[2]]);
                    }
                }
            }
            if (isset($request->captions)) {
                foreach ($request->captions as $key => $caption) {
                    if (array_key_exists(1, $caption) && array_key_exists(2, $caption) &&  !is_null($caption[2]) && !is_null($caption[1])) {

                        $picextension = $caption[2]->getClientOriginalExtension();
                        $fileName = 'caption_' . $key . date("Y-m-d") . '_' . time() . '.' . $picextension;
                        $session = session()->put('temp', $caption[2]->getPathName());
                        $status =  $this->upload_with_ftp($fileName, "video");
                        if (!$status) abort(404);
                        $captionPath = "caption/$fileName";
                        $post->captions()->create(['url' => $captionPath, 'lang' => $caption[1]]);
                    }
                }
            }
        }
        if ($post->type !== 'video') {
            if (isset($request->file)) {
                $picextension = $request->file('file')->getClientOriginalExtension();
                $fileName = 'audio_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
                $status =  $this->upload_with_ftp($fileName, $destinationPath);
                if (!$status) abort(404);
                $post->files()->create(['url' => "$destinationPath/$fileName", 'type' => 'audio']);
            }
        }
        if (isset($request->playlists)) {
            foreach ($request->playlists as $key => $playlist) {
                if ($post->playlists()->pluck('id')->contains($playlist)) {
                    continue;
                }
                if ($id = PlayList::check($playlist)) {
                    $post->playlists()->attach($id);
                }
            }
        }


        if (isset($request->singers)) {
            $post->artists()->where('role', 'singer')->detach();
            foreach ($request->singers as $key => $singer) {

                if ($id = Artist::check($singer)) {
                    $post->artists()->attach($id);
                }
            }
        }
        if (isset($request->writers)) {
            $post->artists()->where('role', 'writer')->detach();
            foreach ($request->writers as $key => $writer) {

                if ($id = Artist::check($writer)) {
                    $post->artists()->attach($id);
                }
            }
        }

        $post->categories()->detach();
        if (isset($request->category)) {

            if ($request->category !== null) {
                if ($id = Category::check($request->category)) {
                    $post->categories()->attach($id);
                }
            }
        }


        if (isset($request->arrangements)) {
            foreach ($request->arrangements as $key => $arrangement) {
                if ($post->arrangements()->pluck('name')->contains($arrangement)) {
                    continue;
                }
                if ($id = Arrangement::check($arrangement)) {
                    $post->arrangements()->attach($id);
                } else {

                    $post->arrangements()->create(['name' => $arrangement]);
                }
            }
        }
        if (isset($request->albums)) {
            $post->albums()->detach();
            foreach ($request->albums as $key => $album) {

                $post->albums()->attach($album);
            }
        }
    }


    public function SavePoster($file, $name, $destinationPath)
    {
        // dd($file);
        if ($file) {
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0777, true);
            }
            $picextension = $file->getClientOriginalExtension();
            $fileName = $name . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $imagePath = $destinationPath . '/' . $fileName;
            $file->move(public_path($destinationPath), $fileName);
            return "$destinationPath/$fileName";
        } else {

            return '';
        }
    }
    public function image_resize($width, $height, $poster, $destinationPath)
    {
        if ($poster !== '') {


            $picextension = pathinfo($poster, PATHINFO_EXTENSION);
            $fileName = $width . 'x' . $height . '-' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $imagePath = $destinationPath . '/' . $fileName;
            $imgs = Image::make($poster)->resize($width, $height)->save($imagePath);

            return $imagePath;
        }
    }



    public function get_duration($file)
    {
        $getID3 = new \getID3;
        $fil = $getID3->analyze($file);

        return date('i:s', $fil['playtime_seconds']);
    }

    public function upload_with_ftp($fileName, $destinationPath)
    {

        $ftp_server = env('FTP_HOST');
        $ftp_user_name = env('FTP_USERNAME');
        $ftp_user_pass = env('FTP_PASSWORD');
        $conn_id = ftp_connect($ftp_server);
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        ftp_pasv($conn_id, true);
        if ((!$conn_id) || (!$login_result)) {
            return false;
        }
        if (is_array(session()->get('temp'))) {

            foreach (session()->get('temp') as $key => $item) {

                $upload = ftp_put($conn_id, "$destinationPath/$fileName", $item[1], FTP_BINARY);
            }
        } else {

            $upload = ftp_put($conn_id, "$destinationPath/$fileName", session()->get('temp'), FTP_BINARY);
        }
        ftp_close($conn_id);
        return $upload;
    }

    public function delete_with_ftp($file_path)
    {
        $ftp_server = env('FTP_HOST');
        $ftp_user_name = env('FTP_USERNAME');
        $ftp_user_pass = env('FTP_PASSWORD');
        $conn_id = ftp_connect($ftp_server);
        $login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);
        ftp_pasv($conn_id, true);

        $file_size = ftp_size($conn_id, $file_path);
        if ($file_size != -1) {
            $status = ftp_delete($conn_id, $file_path);
        }
        // close the connection
        ftp_close($conn_id);
    }

    public function send_mail($user)
    {
        $data = array('password' => $user->password);
        Mail::send(['html' => 'mail'], $data, function ($message) use($user) {
            $message->to($user->email, 'radio avin')->subject('Forget Password');
            $message->from('info@radioavin.com', 'RadioAvin');
        });

        if(Mail::failures()) {
            return false;
        }
        return true;

    }
}
