<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function say_hello(){
        return response()->json([
            "message"=>"Hello from the other side"
        ]);
    }
}
