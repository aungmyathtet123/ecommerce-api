<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryIDResource extends JsonResource
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
            'key'=>$this->id,
            'value'=>$this->id,
            'label'=>$this->name,
            'enname'=>$this->enname,
            'cnname'=>$this->cnname,
            'mmname'=>$this->mmname,
            'slug'=>$this->slug,
            'image'=>$this->icon,
            'children'=>ProductCategoryIDResource::collection($this->childrens)
        ];
    }
}
