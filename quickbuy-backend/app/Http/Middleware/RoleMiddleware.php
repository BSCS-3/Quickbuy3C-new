<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    // Define the role hierarchy
    private $roleHierarchy = [
        'customer' => 1,
        'seller'   => 2,
        'admin'    => 3,
    ];

    public function handle(Request $request, Closure $next, $requiredRole): Response
    {
        $user = $request->user(); // Get authenticated user

        if (!$user || !$user->roles()->exists()) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        // Get the highest role level of the user
        $userMaxRoleLevel = $user->roles->max(function ($role) {
            return $this->roleHierarchy[$role->name] ?? 0;
        });

        // Get required role level
        $requiredRoleLevel = $this->roleHierarchy[$requiredRole] ?? 0;

        // Strictly enforce access only for their specific level
        if ($userMaxRoleLevel !== $requiredRoleLevel && $userMaxRoleLevel < 3) { 
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
