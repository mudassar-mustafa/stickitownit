<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AttributeValue extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'attribute_values';

    protected $guarded =[];

    /**
    * @return BelongsTo
    */
    public function attribute(): BelongsTo 
    {
        return $this->belongsTo(Attribute::class);
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_attribute_value_groups', 'product_attribute_val_id', 'product_id');
    }

    /**
     * @return BelongsToMany
     */
    public function product_attribute_group(): BelongsToMany
    {
        return $this->belongsToMany(ProductAttributeGroup::class, 'product_attribute_value_groups', 'product_attribute_val_id', 'product_group_id');
    }
}
