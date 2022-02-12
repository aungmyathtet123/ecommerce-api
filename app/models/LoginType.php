<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class LoginType extends Model
{
    public function users(){
        return $this->hasMany(User::class);
    }
}
