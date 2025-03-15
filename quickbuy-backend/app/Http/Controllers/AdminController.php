<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Middleware\RoleMiddleware;

class AdminController extends Controller
{
    public function checkHealth(){
        return response()->json([
            "message" => "working"
        ]);
    }
}
