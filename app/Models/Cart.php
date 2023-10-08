<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\UploadFile;

class Cart extends Model
{

    use HasFactory, SoftDeletes, UploadFile;

    protected $table = 'carts';

    protected $guarded =[];

    /**
     * Always the icon when it is updated.
     * @param $value
     * @return string
    */
    public function setImagePathAttribute($value)
    {
        $imageName = '';
        if (!is_null($value) && $value !== '') {
            $imageName =  $this->upload($value, 'carts');
            $this->attributes['image_path'] = $imageName;
        }
    }


    /**
     * @param $value
     * @return string
     */
    public function getImagePathAttribute($value): String
    {
        return asset('/storage/uploads/carts/' . $value);
    }

    /**
    * @return BelongsTo
    */
    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }


    /**
    * @return BelongsTo
    */
    public function product_attribute_group_detail(): BelongsTo 
    {
        return $this->belongsTo(ProductAttributeGroup::class, 'product_attribute_group_id', 'id');
    }
}
