<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class roleUser extends Model
{
  protected $fillable = [
    'user_id', 'role_id',
  ];
}