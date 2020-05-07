<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class itemImagePath extends Model
{
  protected $fillable = [
    'file_location','item_id'
  ];
  public function Items(){
    return $this->belongsTo('App\Items');
  }
  
}
