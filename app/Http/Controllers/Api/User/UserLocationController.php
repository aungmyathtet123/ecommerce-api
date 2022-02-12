<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\models\UserLocation;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserLocationResource;
class UserLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userlocations=UserLocation::all();
        return response()->json([
            'data'=>UserLocationResource::collection($userlocations)
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
        $validator=Validator::make($request->all(),[
            'name'=>'required|string',
            'slug'=>'required|string',
            'address'=>'required',
        ]);
        if($validator->fails()){
            return response(['errors'=>$validator->errors()->all()],422);
        }


        $user=Auth::guard("api")->user();
        $user->userlocation()->attach($request->location_id,['name'=>$request->name,'slug'=>$request->slug,'address'=>$request->address]);
        $response = ['data' => UserLocationResource::collection($user->userlocation)];
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
    public function update(Request $request, UserLocation $userlocation)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLocation $userlocation)
    {
        $userlocation->delete();
        return response('delete successfully');
    }
}
