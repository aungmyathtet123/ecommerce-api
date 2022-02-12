<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductSlideShowResource;
use App\models\ProductSlideShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductSlideShowController extends Controller
{

    public function index()
    {
        $slideshows=ProductSlideShow::orderBy('created_at','desc')->get();
        return response(['data'=>$slideshows], 200);
    }

    public function store(Request $request)
    {
        $datas=$request->toArray();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'caption' => 'required|string',
            'image' => 'required|string',
            'product_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $slideshow=ProductSlideShow::create($datas);
        return response(['data'=>$slideshow], 200);
    }


    public function show($id)
    {
        $slideshows=ProductSlideShow::orderBy('created_at','desc')->where('type',$id)->get();
        return response(['data'=>$slideshows], 200);
    }


    public function update(Request $request, $id)
    {

    }


    public function destroy($id)
    {
        $product=ProductSlideShow::find($id);
        $product=$product->delete();
        $response = ['data' => $product];
        return response($response, 200);
    }
}
