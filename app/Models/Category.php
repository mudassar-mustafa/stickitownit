<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $guarded = [];


    /**
     * Always the image when it is updated.
     * @param $value
     * @return string
     */
    public function setImageAttribute($value)
    {

        $imageName = '';
        if (!is_null($value) && $value !== '') {
            $imageName = time() . '.' . $value->getClientOriginalExtension();
            $destinationPathThumbail = public_path('/uploads/categories/images');
            $value->move($destinationPathThumbail, $imageName);
            $this->attributes['image'] = $imageName;
        }


    }

    /**
     * Always the icon when it is updated.
     * @param $value
     * @return string
     */
    public function setIconAttribute($value)
    {
        $imageName = '';
        if (!is_null($value) && $value !== '') {
            $imageName = time() . '.' . $value->getClientOriginalExtension();
            $destinationPathThumbail = public_path('/uploads/categories/icons');
            $value->move($destinationPathThumbail, $imageName);
            $this->attributes['icon'] = $imageName;
        }

    }

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return asset('/uploads/categories/images/' . $value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getIconAttribute($value)
    {
        return asset('/uploads/categories/icons/' . $value);

    }


    /**
     * @return BelongsToMany
     */
    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_categories', 'category_id', 'product_id');
    }
}
