<?php

namespace App\Models\api;

use App\Models\Category;
use App\Models\Question;
use App\Models\QuestionsSendRequest;
use App\Models\Rate;
use App\Models\Role;
use App\Models\UsersDetail;
use App\Models\UsersSpecialty;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','phone','is_provider','address',
        'lisence_number','lisence_document','is_company','c_name','whatsapp',
        'state_id','city_id','verification_code','admin_id'
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

}
