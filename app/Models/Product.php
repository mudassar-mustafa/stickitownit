<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\UploadFile;

class Product extends Model
{
    use HasFactory, SoftDeletes, UploadFile;

    protected $table = 'products';

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
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    /**
    * @return BelongsTo
    */
    public function brand(): BelongsTo 
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * @return BelongsToMany
     */
    public function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes', 'product_id', 'attribute_id');
    }

    /**
    * @return HasMany
    */
    public function product_groups(): HasMany
    {
        return $this->hasMany(ProductAttributeGroup::class,'product_id','id');
    }

    /**
     * @return BelongsToMany
     */
    public function attribute_values(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_value_groups', 'product_id', 'product_attribute_val_id')->groupBy('product_attribute_val_id');
    }

    /**
     * @return BelongsToMany
     */
    public function product_attribute_group(): BelongsToMany
    {
        return $this->belongsToMany(ProductAttributeGroup::class, 'product_attribute_value_groups', 'product_id', 'product_group_id');
    }

    /**
    * @return HasMany
    */
    public function product_images(): HasMany
    {
        return $this->hasMany(ProductImage::class,'product_id','id')->orderBy('order', 'asc');
    }
}
