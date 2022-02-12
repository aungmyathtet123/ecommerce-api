<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $fillable=['avatar','birthday','gender_id','status_id','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function status(){
        return $this->belongsTo(UserStatus::class);
    }
    public function gender(){
        return $this->belongsTo(Gender::class)->withDefault(function () {
            return new Gender();
        });
    }
}
