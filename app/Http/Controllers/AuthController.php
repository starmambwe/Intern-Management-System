<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt authentication
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful! Redirecting...',
                'redirect' => url('/') // Redirect to home if successful
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid email or password!'
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout(); // Log the user out
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return response()->json([
            'status' => 'success',
            'message' => 'Logged out successfully!'
        ]);
    }
}
