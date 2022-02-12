<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function addwishlist(Request $request)
    {
        $user=Auth::guard("api")->user();
        $user->wishlist()->attach($request->product_id);
        $response = ['data' => 'Add WishList'];
        return response($response, 200);
    }

    public function removewishlist(Request $request)
    {
        $user=Auth::guard('api')->user();
        $user->wishlist()->detach();
        return response(['data'=>'removed wishlist']);
    }
}
