<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate and create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Generate a personal access token for the user
        $token = $user->createToken('Laravel')->accessToken;

        return response()->json(['token' => $token], 201);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
           // $token = Auth::user()->createToken('Laravel')->accessToken;
            $user = Auth::user();
            $user['token'] = $user->createToken('Laravelia')->accessToken;
            return response()->json(['user' => $user], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
