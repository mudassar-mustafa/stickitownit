<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'attributes';

    protected $guarded =[];


    /**
    * @return HasMany
    */
    public function attribute_values(): HasMany
    {
        return $this->hasMany(AttributeValue::class,'attribute_id','id')->where('status', 'active');
    }

    /**
     * @return BelongsToMany
     */
    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_attributes', 'attribute_id', 'product_id');
    }
}
