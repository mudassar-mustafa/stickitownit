<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'countries';

    protected $guarded =[];

    /**
    * @return HasMany
    */
    public function states(): HasMany
    {
        return $this->hasMany(State::class,'country_id','id');
    }

    /**
    * @return HasMany
    */
    public function order_billing_address_country(): HasMany
    {
        return $this->hasMany(Order::class,'billing_country_id','id');
    }

    /**
    * @return HasMany
    */
    public function order_shipping_address_country(): HasMany
    {
        return $this->hasMany(OrderSaleDetail::class,'shipping_country_id','id');
    }

}
