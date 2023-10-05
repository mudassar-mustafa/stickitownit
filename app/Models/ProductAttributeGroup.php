<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Traits\UploadFile;

class ProductAttributeGroup extends Model
{
    use HasFactory, SoftDeletes, UploadFile;

    protected $table = 'product_attribute_groups';

    protected $guarded =[];

    /**
     * Always the icon when it is updated.
     * @param $value
     * @return string
     */
    // public function setMainImageAttribute($value)
    // {
    //     $imageName = '';
    //     if (!is_null($value) && $value !== '') {
    //         $imageName =  $this->upload($value, 'products');
    //         $this->attributes['main_image'] = $imageName;
    //     }
    // }


    /**
     * @param $value
     * @return string
     */
    public function getMainImageAttribute($value): String
    {
        return asset('/storage/uploads/products/' . $value);
    }

    /**
    * @return BelongsTo
    */
    public function product(): BelongsTo 
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_attribute_value_groups', 'product_group_id', 'product_id');
    }

    /**
     * @return BelongsToMany
     */
    public function attribute_values(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_value_groups', 'product_group_id', 'product_attribute_val_id');
    }
}
