<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdFile extends Model
{
    protected $fillable=['advertisement_id','file'];

    public function advertisement(){
        return $this->belongsTo('App\Advertisement');
    }
}
