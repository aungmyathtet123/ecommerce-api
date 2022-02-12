<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable=['name','slug','enname','cnname','mmname','icon','order','parent'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function childrens(){
        return $this->hasMany(ProductCategory::class,'parent','id')->orderBy('order');
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
