<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable=['slider'];

    protected $appends = ['image_path'];

    public function getImagePathAttribute()
    {

        return $this->slider !== null ? asset($this->slider) : asset('asset2/images/user-icon.jpg');

    }
}
