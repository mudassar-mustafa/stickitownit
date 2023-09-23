<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAttributeValueGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_attribute_value_groups';

    protected $guarded =[];

    /**
    * @return BelongsTo
    */
    public function attribute_values(): BelongsTo 
    {
        return $this->belongsTo(AttributeValue::class,'product_attribute_val_id','id');
    }
}
