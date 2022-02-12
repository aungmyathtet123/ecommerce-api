<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductPriceResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ProductPrice;
class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productprices=ProductPrice::all();
        return response(['data'=>ProductPriceResource::collection($productprices)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->toArray(),[
            'price'=>'required',
        ]);

        if($validator->fails()){
            return response(['error'=>$validator->errors()->all(),422]);
        }

        $productprice=ProductPrice::create($request->toArray());
        return response(['data'=>$productprice],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productprice=ProductPrice::find($id);
        return response(['data'=>$productprice],200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productprice=ProductPrice::find($id);
        $productpriceU=$productprice->update($request->toArray());
        return response(['data'=>$productpriceU],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productprice=ProductPrice::find($id);
        $productprice->delete();
        return response([null]);
    }
}
