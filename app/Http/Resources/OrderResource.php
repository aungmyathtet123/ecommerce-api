<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'order_no'=>$this->order_no,
            'user'=>$this->user,
            'address'=>$this->user_address_id,
            'status'=>$this->status,
            'grandtotal'=>$this->grandtotal,
            'shippingfees'=>$this->shippingfees,
            'paymentmethod'=>$this->payment->name,
        ];
    }
}
