<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request) {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validator->fails()) {

            return BaseController::msg(0, $validator->getMessageBag(), 422);
//            return response()->json([
//                'status' => 0,
//                'message' => $validator->getMessageBag(),
//            ], 422);
        };

//        $user = User::query()->where('email', $request->email)->first();
        $user = User::query()->whereEmail($request->email)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)) {
                Auth::login($user);
//                return response()->json([
//                    'status' => 1,
//                    'message' => 'Login Successfully',
//                    'user' => $request->user(),
//                ], 200);

                $data = [
                    'user' => $request->user()->refresh(),
//                    'user' = $user->refresh(),
                    'token' => $request->user()->createToken('login')->accessToken,
                ];

//                return BaseController::msg(1, 'Login Successfully',200,  $request->user());
                return BaseController::msg(1, 'Login Successfully',200,  $data);
            } else {
//                return response()->json([
//                    'status' => 1,
//                    'message' => 'Password does not match',
//                    'user' => [],
//                ], 401);
                return BaseController::msg(1, 'Password does not match',401);
            }
        } else {
//            return response()->json([
//                'status' => 1,
//                'message' => 'There is no user found',
//                'user' => [],
//            ], 401);
            return BaseController::msg(1, 'There is no user found',404);
        }

//        if(Auth::attempt($request->all())) {
//            return response()->json([
//                'status' => 1,
//                'message' => 'Login Successfully',
//                'user' => $request->user(),
//            ]);
//        }


    }

    public function register(Request $request) {

//        $validator = new Validator();
//        $validator  = $validator->make();

        $validator = Validator::make($request->all(), [
            "name" => 'required',
            "email" => 'required|unique:users,email',
            "phone" => 'required|unique:users,phone',
            "password" => ['required','confirmed'],
        ]);

        if($validator->fails()) {
            return BaseController::msg(0, $validator->getMessageBag(), 422);
        }

        $otp = rand(000000,999999);


//        $msg = "Thanks for registration your OTP is $otp";

        $user = User::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
//            'password' => Hash::make(),
            'password' => bcrypt($request->password),
            'otp_code' => $otp,
        ]);

        Auth::login($user);

        // SMS::send($request->phone, $msg);

        $data = [
            'user' => $user,
            'token' => $user->createToken('register')->accessToken,
        ];

        return BaseController::msg(1, "Registration Successfully", 200, $data);

    }
}
