<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $casts = ['icon' => 'array'];


    public function products()
    {
        return $this->hasMany('App\Product');
    }
    public function children()
    {
        return $this->hasMany($this, 'parent_id')->with('children');
    }
    public function parent()
    {
        return $this->belongsTo($this, 'parent_id')->with('parent');
    }

    public function features()
    {
        return $this->hasMany('App\Feature','category_id');
    }

}
