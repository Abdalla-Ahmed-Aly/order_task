<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $product=Product::all();
                    return response()->json(["status"=>"done","data"=>$product]);

    }

  
    public function store(ProductRequest $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json(["status" => "done", "data" => $product]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $product=Product::find($id);
        if($product){
            return response()->json(["status"=>"done","data"=>$product]);
        }else{
            return response()->json(["status"=>"error","message"=>"Product not found"]);
        }
    }

    public function update(ProductRequest $request, string $id)
    {
        $product=Product::find($id);
        if($product){   
            $product->update([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'description' => $request->description,
                'price' => $request->price,
            ]);
            return response()->json(["status"=>"done","data"=>$product]);
        } else{
            return response()->json(["status"=>"error","message"=>"Product not found"]);
    
    }

}

 
    public function destroy(string $id)
    {
        $product=Product::find($id);
        if($product){
            $product->delete();
            return response()->json(["status"=>"done","message"=>"Product deleted"]);
        } else{
            return response()->json(["status"=>"error","message"=>"Product not found"]);
        }
 
    }
}
