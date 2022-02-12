<?php

namespace App;

use App\models\LoginType;
use App\models\Product;
use App\models\UserInfo;
use App\models\UserType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','phone', 'password','type_id','login_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info(){
        return $this->hasOne(UserInfo::class);
    }
    public function type(){
        return $this->belongsTo(UserType::class);
    }
    public function loginType(){
        return $this->belongsTo(LoginType::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    public function isAdmin(){
        if($this->type_id==1){
            return true;
        }
        return false;
    }
    public function isSeller(){
        if($this->type_id==2){
            return true;
        }
        return false;
    }
    public function carts(){
        return $this->belongsToMany(Product::class,'carts')->withPivot('quantity','id');
    }

    public function wishlist()
    {
        return $this->belongsToMany('App\models\Product','wish_lists','user_id','product_id','id');
    }

    public function userlocation()
    {
        return $this->belongsToMany('App\models\Location','user_locations','user_id','location_id','id')
                    ->withPivot('name','cnname','enname','mmname','slug','order','active','address');
    }
}
