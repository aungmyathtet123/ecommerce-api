<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['CORS']],function(){
    Route::post('/user/register','Api\Auth\UserController@register');
    Route::post('/user/login','Api\Auth\UserController@login');
    Route::get('/user/categories','Api\User\ProductController@getCategories');
    Route::get('/user/setting/{name}','Api\User\SettingController@show');
    Route::get('/user/slideshow','Api\User\SettingController@slideshow');
    Route::get('/user/product/{product}','Api\User\ProductController@getSingleProduct');
});

Route::group(['middleware'=>['CORS','auth:api']],function(){
    Route::get('/user/profile','Api\Auth\UserController@profile');
    Route::put('/user/profile','Api\Auth\UserController@profileUpdate');
    Route::post('/user/logout','Api\Auth\UserController@logout');
    Route::apiResource('/user/cart','Api\User\CartController');
    Route::delete('/user/cartalldelete','Api\User\CartController@allDestroy');
    Route::apiResource('/user/paymentmethod','Api\User\PaymentMethodController');
    Route::apiResource('/user/order','Api\User\OrderController');
    Route::post('/user/addwishlist','Api\User\WishListController@addwishlist');
    Route::delete('/user/removewishlist','Api\User\WishListController@removewishlist');
    Route::apiResource('/user/userlocation','Api\User\UserLocationController');

});

Route::group(['middleware'=>['CORS','auth:api','admin']],function(){
    Route::apiResource('/admin/category','Api\ProductCategoryController');
    Route::put('/admin/categoryorder','Api\ProductCategoryController@updateOrderParent');
    Route::get('/admin/categoryid','Api\ProductCategoryController@index2');
    Route::apiResource('/admin/addresstype','Api\AddressTypeController');
    Route::apiResource('/admin/location','Api\LocationController');
    Route::apiResource('/admin/product','Api\ProductController');
    Route::put('/admin/locationorder','Api\LocationController@updateOrderParent');
    Route::get('/admin/setting/{name}','Api\SettingController@show');
    Route::post('/admin/setting/{name}','Api\SettingController@update');
    Route::apiResource('/admin/productslideshow','Api\Admin\ProductSlideShowController');
    Route::apiResource('/admin/productspecification','api\ProductSpecificationController');
    Route::apiResource('admin/productdetail','Api\ProductDetailController');
    Route::apiResource('admin/productprice','Api\ProductPriceController');
    Route::apiResource('admin/productimage','Api\ProductImageController');
    Route::apiResource('admin/productstock','Api\ProductStockController');
});
