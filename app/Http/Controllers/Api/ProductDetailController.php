<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\ProductDetail;

class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productdetails=ProductDetail::all();
        return response()->json([
            'data'=>ProductDetailResource::collection($productdetails)
        ]);
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
            'value'=>'required',
        ]);
        if($validator->fails()){
            return response(['errors'=>$validator->errors()->all()],422);
        }

        $productdetail=ProductDetail::create($request->toArray());
        $response=['data'=>$productdetail];
        return response($response,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $productdetail=ProductDetail::find($id);
        return response(['data'=>$productdetail],200);
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
        $productdetail=ProductDetail::find($id);
        $productdetailU=$productdetail->update($request->toArray());
        return response()->json([
            'status'=>200,
            'data'=>$productdetailU
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productdetail=ProductDetail::find($id);
        $productdetail->delete();
        return response(['null']);
    }
}
