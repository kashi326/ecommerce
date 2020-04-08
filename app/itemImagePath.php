<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemImagePath extends Model
{
  public function Items(){
    return $this->belongsTo('App\Items');
  }
  
}
