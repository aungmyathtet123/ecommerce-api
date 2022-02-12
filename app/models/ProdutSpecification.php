<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutSpecification extends Model
{
    protected $fillable=[
        'name','value','product_id'
    ];
    public function product()
    {
        return $this->belongsTo('App\models\Product');
    }
}
