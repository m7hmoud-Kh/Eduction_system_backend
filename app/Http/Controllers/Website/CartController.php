<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Http\Response;
use App\Http\Requests\Website\Cart\CartStoreRequest;
use App\Http\Requests\Website\Cart\CartUpdateRequest;
use App\Http\Resources\CartResources;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
 
   
    public function store(CartStoreRequest $request){

            //select product
            $product = Product::find($request->product_id);

            //select cart if exist
            $cart=Cart::where('student_id', Auth::user()->id)->where('product_id',$product->id)->first();

            //check if there such product and quantity and if this cart is exist 
            if($product && ($product->quantity >=$request->quantity) && !$cart){
            $price=$request->quantity * $product->price;
            $student_id= Auth::user()->id;
            $cart=Cart::create(array_merge($request->all(),['student_id'=>$student_id,'price' => $price]));

            return response()->json([
                'message' => 'Created Successfully',
                'status' => Response::HTTP_CREATED,
                'data' => new CartResources($cart)

            ]);
        }
        elseif(!$product){
            return response()->json([
                'message' => 'this product dosent exist'
                
            ]);
        }
        elseif(!($product->quantity >=$request->quantity)){
            return response()->json([
                'message' => 'this quantity is too much '
                
            ]);
        }
        elseif ($cart){
            return response()->json([
                'message' => 'you already select this product'
                
            ]);
        }

}
    public function show()
    {
        $carts=Cart::where('student_id', Auth::user()->id)->get();
        $total=0;
        if ($carts) {
            foreach($carts as $cart){
                $total=$total+$cart->price;
            }
        return response()->json([
            'message' => 'ok',
            'status' => Response::HTTP_OK,
            'data' =>  CartResources::collection($carts),
            'total'=>$total,
        ]);
        
        }else {
            return response()->json([
                'message' => 'Not Found',
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }
    
    }

    public function update(CartUpdateRequest $request)
    {
        //select the product id and the price for update
        $product = Product::find($request->product_id);
        

        //check if there is such product and quantity
        if($product && ($product->quantity >=$request->quantity)){
            //select the cart to update
            $cart=Cart::where('student_id', Auth::user()->id)->where('product_id',$product->id)->latest()->first();

            //check if there is such product in his cart
            if($cart){
                $price=$request->quantity * $product->price;    
                $cart->update(array_merge($request->all(),['price' => $price]));
                return response()->json([
                    'message' => 'Update',
                    'status' => Response::HTTP_NO_CONTENT
                ]);
            }
            else{
                return response()->json([
                    'message' => 'you dont have this product in your cart',
                ]);
            }
        }
        elseif(!$product){
            return response()->json([
                'message' => 'this product dosent exist'
                
            ]);
        }
        elseif(!($product->quantity >=$request->quantity)){
            return response()->json([
                'message' => 'this quantity is too much '
                
            ]);
        }
    }

   
    public function destroy()
    {
        $carts=Cart::where('student_id', Auth::user()->id)->get();
        foreach($carts as $cart){
            $cart->delete();
        }
        return response()->json([
            'message' => 'Delete',
            'status' => Response::HTTP_NO_CONTENT,
        ]);
    }

   
}
