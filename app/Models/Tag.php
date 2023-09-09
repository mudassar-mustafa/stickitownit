<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tags';
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class, 'blog_tag_pivots', 'tag_id', 'blog_id')->orderBy('created_at', 'DESC');
    }
}
