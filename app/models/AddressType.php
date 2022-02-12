<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AddressType extends Model
{
    protected $fillable=['name','slug','enname','cnname','mmname','icon','order'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
