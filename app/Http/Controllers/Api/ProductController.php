<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $products=Product::orderBy('created_at','desc')->get();
        return response()->json([
            'data'=>ProductResource::collection($products)
        ]);
    }


    public function store(Request $request)
    {
        $datas=$request->all();
        $categories=[];
        $images=[];
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
            'price' => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        if(isset($datas['category_id'])){
            $categories=$datas['category_id'];
            unset($datas['category_id']);
        }
        if(isset($datas['images'])){
            foreach($datas['images'] as $image){
                $images[]=['images'=>$image['url']];
            }
            unset($datas['images']);
        }
        $product=new Product($datas);
        $product=Auth::guard("api")->user()->products()->save($product);
        $product->categories()->sync($categories);


        // $product->wishlist()->sync()
        $product->images()->delete();
        $product->images()->createMany($images);
        return $product;
    }


    public function show(Product $product)
    {
        $response = ['data' =>new ProductResource($product)];
        return response($response, 200);
    }

    public function update(Request $request, Product $product)
    {
        $datas=$request->all();
        $categories=[];
        $images=[];
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
            'price' => 'required|numeric',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        if(isset($datas['category_id'])){
            $categories=$datas['category_id'];
            unset($datas['category_id']);
        }
        if(isset($datas['images'])){
            foreach($datas['images'] as $image){
                $images[]=['images'=>$image['url']];
            }
            unset($datas['category_id']);
        }
        $product->update($datas);
        // $product=new Product($datas);
        // $product=Auth::guard("api")->user()->products()->save($product);
        $product->categories()->sync($categories);
        $product->images()->delete();
        $product->images()->createMany($images);
        return $product;
    }

    public function destroy(Product $product)
    {
        $product=$product->delete();
        $response = ['data' => $product];
        return response($response, 200);
    }
}
