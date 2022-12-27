<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','phone','phone_code','is_provider','address',
        'lisence_number','lisence_document','is_company','c_name','whatsapp','country_id',
        'state_id','city_id','verification_code','admin_id','email_verification_code','email_verified_at',
        'time_token','time_verified','provider_id','provider_name','temp_token'
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

    protected $appends = ['avatar_path'];


    public function getAvatarPathAttribute()
    {

        return $this->avatar !== null ? asset($this->avatar) : asset('asset2/images/user-icon.jpg');

    }


    public function state(){
        return $this->belongsTo('App\State');
    }
    public function country(){
        return $this->belongsTo('App\Country');
    }
}
