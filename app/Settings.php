<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable=['site_name','site_logo','email','phone','whatsapp','address','status'];
}
