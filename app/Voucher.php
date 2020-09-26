<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Voucher extends Model
{
  use SoftDeletes;

  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
}
