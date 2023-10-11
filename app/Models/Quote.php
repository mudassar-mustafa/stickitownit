<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quote extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'quotes';
    protected $guarded = [];

    /**
     * @param $value
     * @return string
     */
    public function getFileAttribute($value): String
    {
        return asset('/storage/uploads/quotes/' . $value);

    }
}
