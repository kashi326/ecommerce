<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
  protected $fillable = [
   'id','title','description','specification','instruction','category','thumbnail','price','user_id'
];
    public function User(){
      return $this->belongsTo('App\User');
    }
    public function itemImagePath(){
      return $this->hasMany('App\itemImagePath');
    }
    
}
