<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'name'=>$this->name,
            'title'=>$this->name,
            'key'=>$this->slug,
            'enname'=>$this->enname,
            'cnname'=>$this->cnname,
            'mmname'=>$this->mmname,
            'slug'=>$this->slug,
            'image'=>$this->icon,
            'fees'=>$this->fees,
            'from_duration'=>$this->from_duration,
            'to_duration'=>$this->to_duration,
            // 'type'=>$this->type->name,
            'children'=>LocationResource::collection($this->childrens)
        ];
    }
}
