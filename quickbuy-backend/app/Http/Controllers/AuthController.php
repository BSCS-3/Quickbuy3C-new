<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request, $role)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Check if the user exists with the given role
        $user = User::where('email', $request->email)
                    ->whereHas('roles', function ($query) use ($role) {
                        $query->where('name', $role);
                    })->first();

        if (!$user || !Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Generate API token
        $token = $user->createToken($role . '-token')->plainTextToken;

        return response()->json([
            'message' => ucfirst($role) . ' logged in successfully',
            'token' => $token,
            'user' => $user
        ]);
    }
    
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
