<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'title'=>$this->name,
            'key'=>$this->slug,
            'value'=>$this->slug,
            'label'=>$this->name,
            'name'=>$this->name,
            'enname'=>$this->enname,
            'cnname'=>$this->cnname,
            'mmname'=>$this->mmname,
            'slug'=>$this->slug,
            'price'=>$this->price,
            'description'=>$this->description,
            'endescription'=>$this->endescription,
            'cndescription'=>$this->cndescription,
            'mydescription'=>$this->mydescription,
            'stock'=>$this->stock,
            'sold'=>0,
            'categories'=>ProductCategoryOnlyIDResource::collection($this->categories),
            'categoriesData'=>$this->categories,
            'images'=>ProductImageResource::collection($this->images)
        ];
    }
}
