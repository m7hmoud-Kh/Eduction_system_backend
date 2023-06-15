<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
class relation extends Controller
{
    public function get_order(){
        $order=Order::whereId(1)->first();
        $data=$order->product();
         return response()->json($data);
    }
    
     public function get_product_orders(){
        $product=Product::whereId(1)->first();
        $data=$product->order();
         return response()->json($data);
    }
    
    public function add_product_to_order(){
        $order=Order::whereId(1)->first();
        $product=Product::whereId(4)->first();
        $order->product()->attach($product,['quantity'=>1]);
        //sync for remove from datebase and add anew one
        //syncWithoutDetaching for just add anew one
        return "sucess";
    }

    public function update_product_to_order(){
        $order=Order::whereId(1)->first();
        $product=Product::whereId(3)->first();
        $order->product()->sync($product,['quantity'=>1]);
        return "sucess";
    }

    public function update_still_product_to_order(){
        $order=Order::whereId(1)->first();
        $product=Product::whereId(5)->first();
        $order->product()->syncWithoutDetaching($product,['quantity'=>2]);
        return "sucess";
    }
}
