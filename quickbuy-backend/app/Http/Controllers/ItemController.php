<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function find_all(){
        return Item::all();
    }

    public function create(Request $request){
        $item = new Item;

        $item->name = $request->input("name");
        $item->price = $request->input("price");

        $item->save();

        return response()->json([
            "message" => "Success"
        ]);

    }
}
