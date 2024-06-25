<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\OrderItemRequest;
use App\Models\Order;
use App\Models\orderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderitemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $order=orderItem::all();
       return response()->json(['status' => 'done', 'data' => $order]);
    }

    public function store(OrderItemRequest $request)
    {
        $order=Order::create([
            'user_id'=>$request->user_id,
            'total_price'=>0,
           ]);
           foreach ($request->order_items as $item) {
               $product = Product::find($item['product_id']);
               $itemTotalPrice = $product->price * $item['quantity'];


            
              orderItem::create([
            
                   'order_id' => $order->id,
                   'product_id' => $item['product_id'],
                   'quantity' => $item['quantity'],
                   'price' => $product->price,
                   'total_price' => $itemTotalPrice,
               ]);
   
           }
           $order->update(['total_price' => $itemTotalPrice]);

           return response()->json(['status' => 'done', 'data' => $order]);
    }
    
    public function show(string $id)
    {
        $order=orderItem::find($id);
        return response()->json(['status' => 'done', 'data' => $order]);
        
    }
    public function update(OrderItemRequest $request, string $id)
    {
  
        $orderItem=orderItem::find($id); 
        if($orderItem){   
            foreach ($request->order_items as $item) {
                $product = Product::find($item['product_id']);
                $itemTotalPrice = $product->price * $item['quantity'];
  
                $orderItem->update([
                   'product_id' => $item['product_id'],
                   'quantity' => $item['quantity'],
                   'price' => $product->price, 
                   'total_price' => $itemTotalPrice,
                ]);
                $order = $orderItem->order;
                $order->update(['total_price' => $itemTotalPrice]);        
        }
            
           return response()->json(['status' => 'done', 'data' => $order]);
      
        } else {
            return response()->json(['status' => 'error','message'=>'Order Item not found'], 404);
        }
        
    }

  
    public function destroy(string $id)
    {
        $orderItem=orderItem::find($id); 
        if($orderItem){
            $orderItem->delete();
            return response()->json(['status' => 'done','message'=>'Order Item deleted successfully'], 200);
        } else {
            return response()->json(['status' => 'error','message'=>'Order Item not found'], 404);
        }
    }
}
