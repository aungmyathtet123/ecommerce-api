<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{


    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $fillable=[
        'name','cname','enname','mmname','slug','user_id','location_id','order','active','address'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function location()
    {
        return $this->belongsTo('App\models\Location');

    }

}
