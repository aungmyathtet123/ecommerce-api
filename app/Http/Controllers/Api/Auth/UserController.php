<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\models\UserInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required_without:phone|string|email|max:255|unique:users',
            'phone' => 'required_without:email|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        if(isset($request['email'])){
            $request['login_type_id']=1;
        }else{
            $request['login_type_id']=2;
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());

        $info=new UserInfo(['status_id'=>1]);
        $user->info()->save($info);

        $token = $user->createToken('MyanmarSmartCity')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required_without:phone|string|email|max:255',
            'phone' => 'required_without:email|string|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        if(!auth()->attempt($request->toArray())){
            $responseMessage[] = "Invalid username or password";
            return response(['errors'=>$responseMessage], 422);
        }

        $token = auth()->user()->createToken('MyanmarSmartCity')->accessToken;
        $response = ['token' => $token];
        return response($response, 200);
    }

    public function profile(Request $request){
        $data = Auth::guard("api")->user();
        return response()->json([
            "data" => new UserResource($data)
        ], 200);
    }
    public function profileUpdate(Request $request){

        $datas=$request->all();
        unset($datas['status_id']);
        unset($datas['user_id']);

        $data = Auth::guard("api")->user();
        $data->info->update($datas);
        return response()->json([
            "data" => new UserResource($data)
        ], 200);
    }
    public function logout(Request $request){
        $user = Auth::guard("api")->user()->token();
        $user->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
