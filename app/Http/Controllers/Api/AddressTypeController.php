<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\models\AddressType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressTypeController extends Controller
{

    public function index()
    {
        $types=AddressType::orderBy('order')->get();
        return response()->json([
            'data'=>$types
        ]);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string|unique:address_types',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $category = AddressType::create($request->toArray());
        $response = ['data' => $category];
        return response($response, 200);
    }


    public function show(AddressType $addresstype)
    {
        $response = ['data' => $addresstype];
        return response($response, 200);
    }

    public function update(Request $request, AddressType $addresstype)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $category = $addresstype->update($request->toArray());
        $response = ['data' => $category];
        return response($response, 200);
    }


    public function destroy($id)
    {
        //
    }
}
