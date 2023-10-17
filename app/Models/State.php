<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'states';

    protected $guarded =[];

    /**
    * @return BelongsTo
    */
    public function country(): BelongsTo 
    {
        return $this->belongsTo(Country::class);
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
    public function order_billing_address_state(): HasMany
    {
        return $this->hasMany(Order::class,'billing_state_id','id');
    }

    /**
    * @return HasMany
    */
    public function order_shipping_address_state(): HasMany
    {
        return $this->hasMany(OrderSaleDetail::class,'shipping_state_id','id');
    }
}
