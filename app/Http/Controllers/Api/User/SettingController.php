<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductSlideShowResource;
use App\models\ProductSlideShow;
use App\models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
     public function show(Request $request,$name){
        $setting=Setting::where('name',$name)->first();
        $response = ['data' =>json_decode($setting->values)];
        return response($response, 200);
    }
    public function slideshow(Request $request){
        $slideshows=ProductSlideShow::orderBy('created_at','desc')->get();
        return response(['data'=>ProductSlideShowResource::collection($slideshows)], 200);
    }
}
