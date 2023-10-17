<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cities';

    protected $guarded =[];

    /**
    * @return BelongsTo
    */
    public function state(): BelongsTo 
    {
        return $this->belongsTo(State::class);
    }

    /**
    * @return HasMany
    */
    public function cities(): HasMany
    {
        return $this->hasMany(City::class,'state_id','id');
    }

    /**
    * @return HasMany
    */
    public function order_billing_address_city(): HasMany
    {
        return $this->hasMany(Order::class,'billing_city_id','id');
    }

    /**
    * @return HasMany
    */
    public function order_shipping_address_city(): HasMany
    {
        return $this->hasMany(OrderSaleDetail::class,'shipping_city_id','id');
    }
}
