<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::guard("api")->user();
        $response = ['data' => CartResource::collection($user->carts)];
        return response($response, 200);
    }

    public function store(Request $request)
    {
        $user=Auth::guard("api")->user();
        $user->carts()->attach($request->product_id,['quantity'=>$request->quantity]);
        $response = ['data' => CartResource::collection($user->carts)];
        return response($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $cart=Cart::find($id)->update(['quantity'=>$request->quantity]);
        $user=Auth::guard("api")->user();
        $response = ['data' => CartResource::collection($user->carts)];
        return response($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart=Cart::find($id)->delete();
        $user=Auth::guard("api")->user();
        $response = ['data' => CartResource::collection($user->carts)];
        return response($response, 200);
    }
    public function allDestroy(){
        $user=Auth::guard("api")->user();
        $user->carts()->detach();
        $response = ['data' => CartResource::collection($user->carts)];
        return response($response, 200);
    }
}
