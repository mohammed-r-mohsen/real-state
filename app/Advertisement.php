<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Advertisement extends Model
{
    use HasTranslations;

    protected $fillable=['project_title','image','video','thumbnail','title','title_original','slug','desc','desc_original','currency','price','address',
    'whatsapp','area','appart_model','user_id','order_id','state_id','admin_id',
    'city_id','region_id','neighbor_id','category_id','status','shown','lat','lng','type',
    'heating_id','title_deed_id','floor_number_id','floor_count','building_age','bathroom',
    'balacony','furnished','available_for_loan'];
    public $translatable = ['title','desc'];
    protected $appends = ['item_title','item_desc'];
    public $hidden = ['title','desc'];
   

    public function getItemTitleAttribute($value)
    {
        return @$this->title;
    }

    public function getItemDescAttribute($value)
    {
        return @$this->desc;
    }


    public function category(){
        return $this->belongsTo('App\Category');
    }
    public function order(){
        return $this->belongsTo('App\Order');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function country(){
        return $this->belongsTo('App\Country');
    }
    public function state(){
        return $this->belongsTo('App\State');
    }
    public function city(){
        return $this->belongsTo('App\City');
    }
    public function region(){
        return $this->belongsTo('App\Region');
    }
    public function neighbor(){
        return $this->belongsTo('App\Neighbor');
    }
    public function files(){
        return $this->hasMany('App\AdFile');
    }

}

