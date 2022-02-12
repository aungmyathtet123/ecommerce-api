<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
        'order_no','user_id','user_address_id','status','grandtotal','shippingfees','paymentmethod'
    ];

    public function payment()
    {
        return $this->belongsTo('App\models\PaymentMethod','paymentmethod','id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orderproducts()
    {
        return $this->belongsToMany('App\models\Product','order_products','order_id','product_id','id')->withPivot('price','quantity');
    }
}
