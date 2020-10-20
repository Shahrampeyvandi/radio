<?php

namespace App\Http\Controllers\Front;

use App\User;
use App\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function Login()
    {
        $data['title'] = 'Login';
        return view('Front.login', $data);
    }

    public function Register()
    {
    
        $data['title'] = 'Register';
        return view('Front.register', $data);
    }

    public function Verify(Request $request)
    {


        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            $rules = array(
                'username'             => 'required | email',
                'password'         => 'required | min:6',
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::to('login')
                    ->withErrors($validator);
            }
            $member = User::where('email', $request->username)->first();
        } elseif (preg_match("/^09[0-9]{9}$/", $request->username)) {

            $rules = array(
                'username'             => 'required',
                'password'         => 'required | min:6',
            );
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->fails()) {
                $messages = $validator->messages();
                return Redirect::to('login')
                    ->withErrors($validator);
            }
            $member = User::where('mobile', $request->username)->first();
        } else {
            return back()->withErrors(['Data Not Valid']);
        }
        if ($member) {
            if ($request->password == $member->password) {
                Auth::Login($member);
                return redirect()->route('MainUrl');
            } else {
                return Redirect::back()->withErrors(['Check Password']);
            }
        } else {
            return Redirect::back()->withErrors(['User Name Not Exist']);
        }
    }

    public function ConfirmRegister(Request $request)
    {
        // dd($request->all());
        $rules = array(
            'mobile'             => 'nullable | unique:users,mobile',
            'email'             => 'required | email | unique:users,email',
            'password'         => 'required | min:6',

        );
        // $messages = array(
        //     'mobile.required'             => 'شماره همراه الزامی است',
        //     'mobile.unique'             => 'متاسفانه کابری با این شماره تماس ثبت نام کرده است',
        //     'password.min'         => 'رمز عبور غیر مجاز است ',
        // );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $messages = $validator->messages();
            return Redirect::route('S.Register')
                ->withErrors($validator);
        }


        $user = User::create([
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => $request->password,

        ]);


        if ($user) {
            Auth::login($user);
            return redirect()->route('MainUrl');
        }
    }

    public function logout()
    {


        Auth::logout();
        return redirect()->route('MainUrl');
    }
}
