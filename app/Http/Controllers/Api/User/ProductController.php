<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryResource;
use App\Http\Resources\UserProductResource;
use App\models\Product;
use App\models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getCategories(Request $request){
        $categories=ProductCategory::whereNull('parent')->orderBy('order')->get();
        return response()->json([
            'data'=>ProductCategoryResource::collection($categories)
        ]);
    }
    public function getSingleProduct(Product $product){
        return response()->json([
            'data'=>new UserProductResource($product)
        ]);
    }
}
