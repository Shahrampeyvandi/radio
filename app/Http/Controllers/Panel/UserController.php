<?php

namespace App\Http\Controllers\Panel;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\sendMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function list()
    {

        // Mail::to('yasfuny@gmail.com')->send(new sendMail('sfsf'));

        $users = User::all();
        return view('Panel.Users.Lists', compact('users'));
    }


    public function Delete(Request $request)
    {
        $user = User::find($request->user_id);

        $user->delete();
          toastr()->success('User Delete Successfully');
        return back();
    }



    public function Add(Request $request)
    {


        $user = User::create([
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);


        // send sms

        toastr()->success('User Added Successfully');
        return back();
    }


    public function Edit($id)
    {
        return view('Panel.Users.Edit',['user'=>User::find($id)]);
    }
    public function SubmitEdit($id)
    {
        $user = User::find($id);
        $user->mobile = request()->mobile;
        $user->email = request()->email;
        $user->password = request()->password;
        $user->update();

        // send sms

        toastr()->success('User Edit Successfully');
        return back();
    }
}
