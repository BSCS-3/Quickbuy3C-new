<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Middleware\RoleMiddleware;

class AdminController extends Controller
{
    public function hello(Request $request){
        return response()->json([
            "message"=>"Hello!",
            "user"=>$request->user()
        ], 200);
    }
}
