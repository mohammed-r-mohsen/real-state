<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable=['advertisement_id','user_id'];

    public function advertisement(){
        return $this->belongsTo('App\Advertisement');
    }
}
