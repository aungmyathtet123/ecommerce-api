<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{

    public function index()
    {
        $categories=Location::whereNull('parent')->orderBy('order')->get();
        return response()->json([
            'data'=>LocationResource::collection($categories)
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'slug' => 'required|string|unique:locations',
            // 'type_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $category = Location::create($request->toArray());
        $response = ['data' => $category];
        return response($response, 200);
    }

    public function show(Location $location)
    {
        $response = ['data' => new LocationResource($location)];
        return response($response, 200);
    }


    public function update(Request $request, Location $location)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            // 'type_id' => 'required',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $category = $location->update($request->toArray());
        $response = ['data' => $category];
        return response($response, 200);
    }


    public function destroy(Location $location)
    {
        $location=$location->delete();
        $response = ['data' => $location];
        return response($response, 200);
    }

    public function updateOrderParent(Request $request){
        foreach($request->all() as $k1=>$category){
            $c1=Location::find($category['id']);
            $c1->update(['order'=>$k1,'parent'=>null]);

            foreach($category['children'] as $k2=>$subCategory){
                $c2=Location::find($subCategory['id']);
                $c2->update(['order'=>$k2,'parent'=>$category['id']]);

                foreach($subCategory['children'] as $k3=>$subsubCategory){
                    $c3=Location::find($subsubCategory['id']);
                    $c3->update(['order'=>$k3,'parent'=>$subCategory['id']]);
                }
            }
        }
        $categories=Location::whereNull('parent')->orderBy('order')->get();
        return response()->json([
            'data'=>LocationResource::collection($categories)
        ]);
    }
}
