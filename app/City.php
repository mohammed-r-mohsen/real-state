<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasTranslations;
    protected $fillable=['id','name','state_id'];
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

    public function state(){
        return $this->belongsTo('App\State');
    }
    public function regions(){
        return $this->hasMany('App\Region');
    }
}
