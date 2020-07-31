<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecificationItemGroup extends Model
{
    protected $guarded = ['id'];


    protected $casts = [
        'specification_items' => 'array',
    ];
}
