<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $order=Order::all();
        return response()->json(["status"=>"done","data"=>$order]);
    }

    public function store(Request $request)
    {
       $order=Order::create([
        'user_id'=>$request->user_id,
        'total_price'=>$request->total_price,
       ]);
       return response()->json(["status"=>"done","data"=>$order]);
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

 
    public function destroy(string $id)
    {
    }
}
