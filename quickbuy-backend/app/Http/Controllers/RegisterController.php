<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerCustomer(Request $request)
    {
        return $this->register($request, 'customer');
    }

    public function registerSeller(Request $request)
    {
        return $this->register($request, 'seller');
    }

    private function register(Request $request, string $roleName)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Get role by name
        $role = Role::where('name', $roleName)->first();

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 400);
        }

        // Attach the role using the ID
        $user->roles()->attach($role->id);

        return response()->json(['message' => ucfirst($role) . ' registered successfully!'], 201);
    }
}
