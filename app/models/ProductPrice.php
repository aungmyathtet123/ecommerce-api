<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $fillable=[
        'price','product_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\models\Product');
    }
}
