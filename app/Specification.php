<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];


    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
    public function products() {
        return $this->belongsToMany('App\Product');
    }

    public function items()
    {
        return $this->hasMany('App\SpecificationItem');
    }
}
