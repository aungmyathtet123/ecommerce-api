<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email'=>$this->email,
            'phone'=>$this->phone,
            'type'=>$this->type->name,
            'login'=>$this->loginType->name,
            'avatar'=>$this->info->avatar,
            'birthday'=>$this->info->birthday,
            'gender'=>$this->info->gender->name,
            'status'=>$this->info->status->name,
        ];
    }
}
