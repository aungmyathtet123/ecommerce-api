<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $fillable=[
        'quantity','sold','product_id'
    ];

    public function product()
    {
       return $this->belongsTo('App\models\Product');
    }
}
