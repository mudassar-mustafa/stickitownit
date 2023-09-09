<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPhoto extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_photos';
    protected $guarded = [];

    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id', 'id');
    }



}
