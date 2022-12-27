<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasTranslations;
    protected $fillable=['name','country_code','phone_code'];
    public $translatable = ['name'];
    protected $appends = ['item'];

    public function getItemAttribute($value)
    {
        return @$this->name;
    }

    public function cities(){
        return $this->hasMany('App\City');
    }
}
