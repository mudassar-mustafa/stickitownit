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
    public function setMainImageAttribute($value)
    {
        $imageName = '';
        if (!is_null($value) && $value !== '') {
            $imageName =  $this->upload($value, 'products');
            $this->attributes['main_image'] = $imageName;
        }
    }


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
}
