<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Region extends Model
{
    use HasTranslations;
    protected $fillable=['id','name','city_id'];

    public $translatable = ['name'];
    protected $appends = ['item'];

    public function getItemAttribute($value)
    {
        return @$this->name;
    }

    public function city(){
        return $this->belongsTo('App\City');
    }
}
