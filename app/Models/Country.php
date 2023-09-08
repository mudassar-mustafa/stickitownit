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

}
