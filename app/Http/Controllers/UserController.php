<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public function registration(Request $request)
    {

        $validate = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",
            "password" => "required",
            "c_password" => "required|same:password",

        ]);
        if ($validate->fails()) {

            return response()->json([
                'validation_errors' =>
                $validate->errors(), 202]);

        }
       
        $allData = $request->all();
        $allData['password'] = bcrypt($allData['password']);
        $user = User::create($allData);

        return response()->json([
            "status" => 200,
            "message" => "Successfully Registered",
        ]);
    }
    public function login(Request $request)
    {
        if (Auth::attempt(
            [
                "email" => $request->email,
                "password" => $request->password,
            ]
        )) {
            $user = Auth::user();
            $resArr = [];
            $resArr['token'] = $user->createToken('api-application')->accessToken;
            $resArr['name'] = $user->name;
            return response()->json($resArr, 200);

        } else {
            return response()->json(["errors" => "Unauthorized Access, please give your correct email and password"], 203);
        }
    }
    public function logout(Request $request)
    {
        $token = $request->user()->token()->delete();

        if ($token) {
            return "you have sucessfully logout";
        } else {
            return "logout failed";
        }
    }
}
