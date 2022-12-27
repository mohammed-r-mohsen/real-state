<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=['user_id','package_id','start_at','end_at','status',
    'payment_status','price','package_ads_number','admin_id','ads_number','old_ads'];

    public function package(){
        return $this->belongsTo('App\Package','package_id','id');
    }
    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }
    
}

