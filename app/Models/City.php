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
}
