<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ItemController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

#http://127.0.0.1:8000/api/users/get_single/:id
Route::controller(UserController::class)->prefix("users")->group(function(){
    Route::get('/hi', "say_hello");
});

Route::controller(ItemController::class)->prefix("items")->group(function(){
    Route::get('/', "find_all");
    Route::post('/',"create");
});