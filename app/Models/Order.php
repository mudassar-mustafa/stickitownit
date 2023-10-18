<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    protected $guarded =[];



    public function order_sale_details()
    {
        return $this->belongsToMany(OrderSaleDetail::class, 'order_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function buyer_detail(): BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function seller_detail(): BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function billing_country_detail(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'billing_country_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function billing_state_detail(): BelongsTo
    {
        return $this->belongsTo(User::class, 'billing_state_id', 'id');
    }

    /**
    * @return BelongsTo
    */
    public function billing_city_detail(): BelongsTo
    {
        return $this->belongsTo(City::class, 'billing_city_id', 'id');
    }
}
