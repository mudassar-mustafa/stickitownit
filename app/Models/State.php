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
}
