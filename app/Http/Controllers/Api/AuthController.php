<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ActivationCode;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{




    public function verify(Request $request)
    {
        $code = $request->code;
        $mobile = $request->phone;
        $activationCode_OBJ = ActivationCode::where('v_code', $code)->where('mobile', $mobile)->first();
        if ($activationCode_OBJ) {

            // check member 
            if ($member = Member::where('phone', $mobile)->first()) {
                $token = JWTAuth::fromUser($member);
                return response()->json([
                    'code' => 201,
                    'data' => $token,
                    'error' => '',
                ], 200);
            } else {
                $member = new Member;
                $member->phone = $request->phone;
                if ($member->save()) {
                    $token = JWTAuth::fromUser($member);
                    return response()->json([
                        'code' => 201,
                        'data' => $token,
                        'error' => '',
                    ], 200);
                }
            }
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'کد وارد شده اشتباه است',
            ], 200);
        }
    }

    public function register(Request $request)
    {

        if ($member = User::where('email', $request->email)->first()) {

            return response()->json([
                'code' => 400,
                'message' => 'email already exist',
            ], 400);
        }
        $member = new User;
        $member->email = $request->email;
        $member->password = $request->password;

        if ($member->save()) {
            $token = JWTAuth::fromUser($member);
            return response()->json([
                'code' => 200,
                'data' => $token,
                'error' => '',
            ], 200);
        } else {
            return response()->json([
                'code' => 400,
                'message' => 'error in register',
            ], 401);
        }
    }


    public function login(Request $request)
    {

        if ($member = User::where('email', $request->email)->first()) {
            if ($request->password == $member->password) {
                $token = JWTAuth::fromUser($member);
                return response()->json([
                    'code' => $token,
                    'error' => '',
                ], 200);
            } else {
                return response()->json(['error' => 'Password Incorrect'], 401);
            }
        } else {
            return response()->json(
                ['message' => 'User Not Found'],
                401
            );
        }
    }

    public function forgetpass()
    {
        $username = request()->username;

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $field = 'email';
        } elseif (preg_match("/^09[0-9]{9}$/", $username)) {
            $field = 'mobile';
        } else {
            return response()->json(
                ['message' => 'UserName Is Not Valid'],
                401
            );
        }

        if ($member = User::where($field, $username)->first()) {
            if ($field == 'email') {
                $send_mail = $this->send_mail($member);
                if ($send_mail) {
                    return response()->json(
                        ['message' => 'Successfuly ! Check Your Email'],
                        200
                    );
                } else {
                    return response()->json(
                        ['message' => 'Oops! Email Not Send '],
                        401
                    );
                }
            } else {
                // send sms
            }
        } else {
            return response()->json(
                ['message' => 'User Not Found'],
                401
            );
        }
    }

    public function update_profile()
    {
        $user = $this->token(request()->header('Authorization'));
        if (!$user) return response()->json(['error' => 'unauthorized'], 401);
        $user->fname = request()->firstname;
        $user->lname = request()->lastname;
        $user->mobile = request()->mobile;
        if (isset(request()->avatar)) {
            
            $destinationPath = "user_profile";
            $picextension = request()->avatar->getClientOriginalExtension();
            $fileName = 'user_' . date("Y-m-d") . '_' . time() . '.' . $picextension;
            $imagePath = $destinationPath . '/' . $fileName;
            request()->avatar->move(public_path($destinationPath), $fileName);
            $url = "$destinationPath/$fileName";
            $user->avatar = $url;
        }

        $user->update();

        return response()->json($user,200);
    }
}
