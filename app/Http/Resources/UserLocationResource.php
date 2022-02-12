<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserLocationResource extends JsonResource
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
            'name'=>$this->name,
            'enname'=>$this->enname,
            'cnname'=>$this->cnname,
            'mmname'=>$this->mmname,
            'slug'=>$this->slug,
            'order'=>$this->order,
            'active'=>$this->active,
            'address'=>$this->address,
            'user'=>$this->user->name,
            'location'=>$this->location->name

        ];
    }
}
