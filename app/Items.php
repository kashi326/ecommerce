<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public function User(){
      return $this->belongsTo('App\User');
    }
    public function itemImagePath(){
      return $this->hasMany('App\itemImagePath');
    }
    
}
