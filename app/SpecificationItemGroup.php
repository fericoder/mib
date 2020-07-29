<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecificationItemGroup extends Model
{
    protected $casts = [
        'specification_items' => 'array',
    ];
}
