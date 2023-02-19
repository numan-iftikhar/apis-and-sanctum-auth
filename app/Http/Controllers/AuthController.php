<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ];
        return response()->json($response);
    }

    // Logout user
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return response()->json(['message' => 'User logged out.']);
    }
}