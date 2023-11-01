<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerationImage extends Model
{
    use HasFactory;

    protected $table = 'generation_images';
    protected $guarded = [];


    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return asset('/uploads/generations/' . $value);
    }
}
