<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Package extends Model
{
    use HasTranslations;
    protected $fillable=['name','currency','price',
    'offer_price','period','features','desc','ads_number'];


    public $translatable = ['name','features'];
    protected $appends = ['item','item_features'];

    public function getItemAttribute($value)
    {
        return @$this->name;
    }
    public function getItemFeaturesAttribute($value)
    {
        return @$this->features;
    }
}
