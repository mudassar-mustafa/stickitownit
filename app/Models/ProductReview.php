<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductReview extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_reviews';

    protected $guarded = [];

    /**
    * @return BelongsTo
    */
    public function order_detail(): BelongsTo 
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function user_detail(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function product_attribute_group_detail(): BelongsTo 
    {
        return $this->belongsTo(ProductAttributeGroup::class, 'product_attribute_group_id', 'id');
    }
}
