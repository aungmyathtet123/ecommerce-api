<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::all();
        return response()->json([
            'status'=>200,
            'data'=>OrderResource::collection($orders),

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
        $datas=$request->all();
        $validator=Validator::make($request->all(),[
            'order_no'=>'required',
            'grandtotal'=>'required',
            'paymentmethod'=>'required',

        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>422,
                'data'=>$validator->errors()->all(),
            ]);
        }
        $datas['user_id']=Auth::guard('api')->user()->id;
        $order=new Order($datas);
        $order->save();
        $order->orderproducts()->attach($request->product_id,['price'=>$request->price,'quantity'=>$request->quantity]);
        $response=['data'=>$order];
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order=Order::find($id);
        // return ($order->orderproducts()->product_id);
        $order->delete();
        $order->orderproducts()->detach();
        $response = ['data' => $order];
        return response($response, 200);
    }


}
