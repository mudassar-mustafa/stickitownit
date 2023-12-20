<?php

namespace App\Repositories\Frontend;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Contracts\Frontend\BlogPageContract;

class BlogPageRepository extends BaseRepository implements BlogPageContract
{
    protected $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getAllBlogs(){
        return Blog::whereStatus('active')
        ->orderBy('id', 'asc')
        ->select(['id', 'name', 'title', 'slug', 'image', 'created_at', 'author_name'])
        ->paginate(9);
    }

    /**
     * @return mixed
     */
    public function getBlogDetail($slug){
       return Blog::where(['status' => 'active', 'slug' => $slug])->with('categories:id,name', 'tags:id,name')->first();
    }

    /**
     * @return mixed
     */
    public function getRelatedBlog($blogId, $blogAuthorName){
        return Blog::where('author_name', $blogAuthorName)
        ->where('status', 'active')
        ->where('id', '<>', $blogId) // Exclude the current blog post
        ->orderBy('id', 'asc')
        ->get(['id', 'name', 'title', 'slug', 'image', 'created_at', 'author_name']);
    }

    /**
     * @return mixed
     */
    public function getBlogCategories(){
        return BlogCategory::withCount('blogs')->get(['id','name']);
    }

}
