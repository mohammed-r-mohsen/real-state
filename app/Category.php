<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{

    use HasTranslations;
    protected $fillable=['name','image'];
    public $translatable = ['name'];

    protected $appends = ['item','image_path'];

    public function getItemAttribute($value)
    {
        return @$this->name;
    }


    public function getImagePathAttribute()
    {

        return $this->image !== null ? asset($this->image) : asset('asset2/images/user-icon.jpg');

    }


}
