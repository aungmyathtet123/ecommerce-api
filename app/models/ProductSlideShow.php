<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProductSlideShow extends Model
{
    protected $fillable=["name","enname","cnname","mmname",
    "caption","encaption","cncaption","mmcaption",
    "description","endescription","cndescription","mydescription",
    "product_id","image","type"];

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
