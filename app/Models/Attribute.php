<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'attributes';

    protected $guarded =[];


    /**
    * @return HasMany
    */
    public function attribute_values(): HasMany
    {
        return $this->hasMany(AttributeValue::class,'attribute_id','id');
    }
}
