<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;
    protected $fillable=['terms','privacy','banner','about_title','about_desc'];

    public $translatable = ['terms','banner','privacy','about_title','about_desc'];
    protected $appends = ['item_terms','item_banner','item_privacy','item_about_title','item_about_desc'];



    public function getItemTermsAttribute($value)
    {
        return @$this->terms;
    }
    public function getItemBannerAttribute($value)
    {
        return @$this->banner;
    }

    public function getItemPrivacyAttribute($value)
    {
        return @$this->privacy;
    }

    public function getItemAboutTitleAttribute($value)
    {
        return @$this->about_title;
    }

    public function getItemAboutDescAttribute($value)
    {
        return @$this->about_desc;
    }
}
