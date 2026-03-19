<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {


        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = bcrypt($request->password);
        $users->role = $request->role;
        $users->save();
        $token = $users->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token,
            'user' => $users
        ], 201);
    }

    public function login(Request $request)
    {
        $users = User::where('email', $request->email)->first();
        if (!$users || !password_verify($request->password, $users->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
        $token = $users->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message' => 'User logged in successfully',
            'token' => $token,
            'user' => $users
        ], 200);
    }
}
