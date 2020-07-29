<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecificationItemSpecificationItem extends Model
{
    protected $table = 'specification_item_specification_item';

    public function specificationItems()
{
  return $this->belongsToMany(SpecificationItem::class, 'specification_item_specification_item', 'specification_item_id2', 'specification_item_id');
}

}
