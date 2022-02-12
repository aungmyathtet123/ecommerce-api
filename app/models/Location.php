<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable=['name','slug','enname','cnname','mmname','icon','order','parent','type_id','fees',
    'from_duration','to_duration'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function childrens(){
        return $this->hasMany(Location::class,'parent','id')->orderBy('order');
    }

    public function type(){
        return $this->belongsTo(AddressType::class);
    }

    public function userlocation()
    {
        return $this->belongsToMany('App\User','user_locations','user_id','location_id','id')
                    ->withPivot('name','cnname','enname','mmname','slug','order','active','address');
    }
}
