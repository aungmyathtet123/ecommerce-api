<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show(Request $request,$name){
        $setting=Setting::where('name',$name)->first();
        $response = ['data' =>json_decode($setting->values)];
        return response($response, 200);
    }
    public function update(Request $request,$name){
         $setting=Setting::where('name',$name)->first();
         $setting->values=$request->all();
         $setting->save();
         $response = ['data' =>$setting->values];
        return response($response, 200);
    }
}
