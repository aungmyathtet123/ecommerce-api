<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'id'=>$this->id,
            'value'=>$this->slug,
            'name'=>$this->name,
            'enname'=>$this->enname,
            'cnname'=>$this->cnname,
            'mmname'=>$this->mmname,
            'slug'=>$this->slug,
            'price'=>$this->price,
            'quantity'=>$this->pivot->quantity,
            'pid'=>$this->pivot->id,
            'images'=>ProductImageResource::collection($this->images)
        ];
    }
}
