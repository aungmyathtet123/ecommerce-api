<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCategoryIDResource;
use App\Http\Resources\ProductCategoryResource;
use App\models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{

    public function index()
    {
        $categories=ProductCategory::whereNull('parent')->orderBy('order')->get();
        return response()->json([
            'data'=>ProductCategoryResource::collection($categories)
        ]);
    }

    public function index2()
    {
        $categories=ProductCategory::whereNull('parent')->orderBy('order')->get();
        return response()->json([
            'data'=>ProductCategoryIDResource::collection($categories)
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string|unique:product_categories',

        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $category = ProductCategory::create($request->toArray());
        $response = ['data' => $category];
        return response($response, 200);
    }

    public function show(ProductCategory $category)
    {
        $response = ['data' =>new ProductCategoryResource($category)];
        return response($response, 200);
    }

    public function update(Request $request, ProductCategory $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $categoryU = $category->update($request->toArray());
        $response = ['data' => $categoryU];
        return response($response, 200);
    }

    public function destroy(ProductCategory $category)
    {
        $category=$category->delete();
        $response = ['data' => $category];
        return response($response, 200);
    }

    public function updateOrderParent(Request $request){
        foreach($request->all() as $k1=>$category){
            $c1=ProductCategory::find($category['id']);
            $c1->update(['order'=>$k1,'parent'=>null]);

            foreach($category['children'] as $k2=>$subCategory){
                $c2=ProductCategory::find($subCategory['id']);
                $c2->update(['order'=>$k2,'parent'=>$category['id']]);

                foreach($subCategory['children'] as $k3=>$subsubCategory){
                    $c3=ProductCategory::find($subsubCategory['id']);
                    $c3->update(['order'=>$k3,'parent'=>$subCategory['id']]);
                }
            }
        }
        $categories=ProductCategory::whereNull('parent')->orderBy('order')->get();
        return response()->json([
            'data'=>ProductCategoryResource::collection($categories)
        ]);
    }
}
