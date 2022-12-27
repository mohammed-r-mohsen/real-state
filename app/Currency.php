<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Currency extends Model
{
    use HasTranslations;
    protected $fillable=['name','sympol'];

    public $translatable = ['name'];
    protected $appends = ['item'];

    public function getItemAttribute($value)
    {
        return @$this->name;
    }
}
