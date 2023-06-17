<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\Response;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Http\Requests\Dashboard\Product\ProductUpdateRequest;
use App\Http\Resources\ProductResources;

class ProductController extends Controller
{
    public function index()
    {
        
        $allproducts= Product::all();
       
        return response()->json([
            'message' => 'Ok',
            'status' => Response::HTTP_OK,
            'data' => ProductResources::collection($allproducts)
        ]);
    }
}


