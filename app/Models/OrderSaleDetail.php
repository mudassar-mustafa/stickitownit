<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderSaleDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'order_sale_details';

    protected $guarded =[];


    

    /**
    * @return BelongsTo
    */
    public function order(): BelongsTo 
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function product_attribute_group(): BelongsTo 
    {
        return $this->belongsTo(ProductAttributeGroup::class, 'product_attribute_group_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function shipping_country_detail(): BelongsTo 
    {
        return $this->belongsTo(Country::class, 'shipping_country_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function shipping_state_detail(): BelongsTo 
    {
        return $this->belongsTo(User::class, 'shipping_state_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function shipping_city_detail(): BelongsTo 
    {
        return $this->belongsTo(City::class, 'shipping_city_id', 'id');
    }
}
