<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class State extends Model
{
    protected $fillable=['id','name','country_id'];



    use HasTranslations;
    protected $guarded = [];
    public $translatable = ['name'];
    protected $appends = ['item'];

    public function getItemAttribute($value)
    {
        return @$this->name;
    }

    public function cities(){
        return $this->hasMany('App\City');
    }
    public function country(){
        return $this->belongsTo('App\Country');
    }
}
