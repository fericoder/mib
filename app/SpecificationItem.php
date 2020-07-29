<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SpecificationItem extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function specification()
    {
        return $this->belongsTo('App\Specification');
    }

    public function productSpecificationItems()
    {
        return $this->hasMany('App\ProductSpecificationitem');
    }

    public function assignmentItems()
    {
        return $this->belongsToMany(SpecificationItem::class, 'specification_item_specification_item', 'specification_item_id', 'specification_item_id2');

    }

    public function assignmentParents() {
        return $this->belongsToMany('App\SpecificationItem');
    }

}
