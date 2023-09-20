<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_images';

    protected $guarded = [];


    /**
     * Always the icon when it is updated.
     * @param $value
     * @return string
     */
    public function setFileNameAttribute($value)
    {
        $imageName = '';
        if (!is_null($value) && $value !== '') {
            $imageName =  $this->upload($value, 'product/thumbnail');
            $this->attributes['filename'] = $imageName;
        }
    }


    /**
     * @param $value
     * @return string
     */
    public function getFileNameAttribute($value): String
    {
        return asset('/storage/uploads/product/thumbnail' . $value);
    }

    /**
    * @return BelongsTo
    */
    public function product(): BelongsTo 
    {
        return $this->belongsTo(Product::class);
    }
}
