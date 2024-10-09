<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        \Log::info('Login attempt', $request->only('email', 'password'));

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            $token = $user->createToken('MyApp')->accessToken;
            return response()->json(['token' => $token]);
        }

        \Log::warning('Unauthorized login attempt', $request->only('email'));
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
