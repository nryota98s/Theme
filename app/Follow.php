<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
  protected $primaryKey = [
    'user_id',
    'followed_user_id'
  ];

  protected $fillable = [
    'user_id',
    'followed_user_id'
  ];

  public $timestamps = false;
  public $incrementing = false;
}
