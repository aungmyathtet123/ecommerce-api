<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['name','slug','enname','cnname','mmname','description','endescription','cndescription',
    'mydescription','category_id','price','user_id','stock'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function categories(){
        return $this->belongsToMany(ProductCategory::class);
    }

    public function images(){
        return $this->hasMany(ProductImage::class);
    }

    public function carts(){
        return $this->belongsToMany(User::class,'carts')->withPivot('quantity','id');
    }

    public function wishlist()
    {
        return $this->belongsToMany('App\User','wish_lists','user_id','product_id','id');
    }

    public function orderproducts()
    {
        return $this->belongsToMany('App\models\Order','order_products','order_id','product_id','id')->withPivot('price','quantity');
    }

}
