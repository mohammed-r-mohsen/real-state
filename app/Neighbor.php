<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Neighbor extends Model
{
    
    use HasTranslations;
    protected $fillable=['id','name','region_id'];
    public $translatable = ['name'];
    protected $appends = ['item'];

    public function getItemAttribute($value)
    {
        return @$this->name;
    }

    public function region(){
        return $this->belongsTo('App\Region');
    }
}
