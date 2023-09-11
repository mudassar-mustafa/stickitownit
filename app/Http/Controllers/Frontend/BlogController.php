<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::whereStatus('active')
            ->orderBy('id', 'asc')
            ->select(['id', 'name', 'title', 'slug', 'image', 'created_at', 'author_name'])
            ->paginate(9); // Change 9 to the number of items you want per page

        return view('frontend.pages.blogs.list', compact('blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = Blog::where(['status' => 'active', 'slug' => $slug])->with('categories:id,name', 'tags:id,name')->first();
        $relatedBlogs = Blog::where('author_name', $blog->author_name)
            ->where('status', 'active')
            ->where('id', '!=', $blog->id) // Exclude the current blog post
            ->orderBy('id', 'asc')
            ->get(['id', 'name', 'title', 'slug', 'image', 'created_at', 'author_name']);
        $blogCategories = BlogCategory::withCount('blogs')->get(['id','name']);
        return view('frontend.pages.blogs.detail', compact('blog', 'relatedBlogs','blogCategories'));
    }
}
