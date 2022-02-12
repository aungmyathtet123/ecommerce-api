<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductSpecificationResource;
use App\ProdutSpecification;
use Illuminate\Support\Facades\Validator;
class ProductSpecificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productspecifications=ProdutSpecification::all();
        return response()->json([
            'data'=>ProductSpecificationResource::collection($productspecifications)
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
            'name'=>'required|string',
        ]);


        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'errors'=>$validator->errors()->all()
            ]);
        }

            $products=ProdutSpecification::create($request->toArray());

            $response=['data'=>$products];
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
        $product=ProdutSpecification::find($id);
        $response=['data'=>$product];
        return response($response,200);
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
    public function update(Request $request,$id)
    {
        // $validator= Validator::make($request->toArray(),[
        //     'name'=>'required|string',
        // ]);
        // if($validator->fails()){
        //     return response()->json([
        //         'status'=>422,
        //         'errors'=>$validator->errors()->all()
        //     ]);
        // }

        $productspecification=ProdutSpecification::find($id);
        $productspecificationU=$productspecification->update($request->toArray());
        $response=['data'=>$productspecificationU];
        return response($response,200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productspecification=ProdutSpecification::find($id);
        $productspecification->delete();
        return response()->json([
            'status'=>'Deleted',
        ]);
    }
}
