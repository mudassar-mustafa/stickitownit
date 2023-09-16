<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttributeValueGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_attribute_value_groups';

    protected $guarded =[];
}
