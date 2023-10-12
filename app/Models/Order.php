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


    /**
     * @return BelongsToMany
     */
    public function order_sale_details(): HasMany
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
}
