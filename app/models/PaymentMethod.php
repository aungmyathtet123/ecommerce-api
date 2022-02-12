<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable=[
        'name','key'
    ];

    public function order()
    {
        return $this->hasMany('App\models\Order','paymentmethod','id');
    }
}
