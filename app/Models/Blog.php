<?php

namespace App\Models;

use App\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes, UploadFile;

    protected $table = 'blogs';
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_category_pivots', 'blog_id', 'category_id');
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'blog_tag_pivots', 'blog_id', 'tag_id');
    }

    /**
     * @return HasMany
     */
    public function blogImages(): HasMany
    {
        return $this->hasMany(BlogPhoto::class, 'blog_id', 'id');
    }

    /**
     * Always the image when it is updated.
     * @param $value
     * @return string
     */
    public function setImageAttribute($value)
    {

        if (!is_null($value) && $value !== '') {
            $this->attributes['image'] = $this->upload($value, 'blogs/images');
        }
    }

    /**
     * @param $value
     * @return string
     */
    public function getImageAttribute($value)
    {
        return asset('/storage/uploads/blogs/images/' . $value);
    }

}
