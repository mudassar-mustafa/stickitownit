<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogTagPivot extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'blog_tag_pivots';
    protected $guarded = [];
}
