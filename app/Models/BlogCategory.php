<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UploadFile;

class BlogCategory extends Model
{
    use HasFactory, SoftDeletes, UploadFile;

    protected $table = 'blog_categories';
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class, 'blog_category_pivots', 'category_id', 'blog_id')->orderBy('created_at', 'DESC');
    }

    /**
     * Always the image when it is updated.
     * @param $value
     * @return string
     */
    public function setImageAttribute($value)
    {

        if (!is_null($value) && $value !== '') {
            $this->attributes['image'] = $this->upload($value, 'blog-categories/images');
        }


    }

    /**
     * Always the icon when it is updated.
     * @param $value
     * @return string
     */
    public function setIconAttribute($value)
    {
        if (!is_null($value) && $value !== '') {
            $this->attributes['icon'] = $this->upload($value, 'blog-categories/icons');
        }

    }

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return asset('/storage/uploads/blog-categories/images/' . $value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getIconAttribute($value)
    {
        return asset('/storage/uploads/blog-categories/icons/' . $value);

    }
}
