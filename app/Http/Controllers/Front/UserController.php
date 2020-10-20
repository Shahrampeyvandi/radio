<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payment;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Account()
    {
        $user = Auth::user();
        return view('Front.Account');
    }

    public function Profile()
    {
         $user = Auth::user();
        return view('Front.profile',['user'=>$user]);
    }

    public function EditProfile(Request $request)
    {
        // dd($request->all());
       
        $user = User::whereEmail($request->email)->first();
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }
        if($request->hasFile('photo')) {
        
         $user->avatar =   $this->SavePoster($request->file('photo'),'profile_','user_profile');
        }

        $user->update();
      
        return back();
        
    }

    public function Orders()
    {
        $payments = Payment::where('user_id',auth()->user()->id)->latest()->get();
        return view('Front.orders',['payments'=>$payments]);
    }
}
