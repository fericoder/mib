<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
     use SoftDeletes, Sluggable;
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];
    protected $casts = [
        'image' => 'array','color' => 'array'
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }



    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function cartProduct()
    {
        return $this->hasMany('App\CartProduct');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    public function wishlist()
    {
        return $this->belongsToMany('App\Wishlist');
    }
    public function specifications()
    {
        return $this->belongsToMany('App\Specification');
    }
    public function compare()
    {
        return $this->belongsToMany('App\Compare');
    }
    public function colors()
    {
        return $this->belongsToMany('App\Color')->withPivot('amount');;
    }
    public function features()
    {
        return $this->belongsToMany('App\Feature')->withPivot('value');
    }
    public function carts()
    {
        return $this->belongsToMany('App\Cart');
    }


    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    public function galleries()
    {
        return $this->hasMany('App\Gallery');
    }

    public function Facilities()
    {
        return $this->hasMany('App\Facility');
    }


    public function groups()
    {
        return $this->hasMany('App\SpecificationItemGroup');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }



}
