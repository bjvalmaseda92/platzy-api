<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            "email" => "email|required",
            "password" => "required",
            "device" => "required",
        ]);

        if (Auth::attempt($request->only("email", "password"))) {
            return response()->json([
                "token" => $request->user()->createToken($request->device)
                    ->plainTextToken,
                "message" => "Success",
            ]);
        }

        return response()->json(["message" => "Unauthorized"], 401);
        //retutn no login
    }
}
