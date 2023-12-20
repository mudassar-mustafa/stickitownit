<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\Frontend\BlogPageContract;

class BlogController extends Controller
{

    /**
     * @var BlogPageContract
     */
    protected $blogPageRepository;

    public function __construct(BlogPageContract $blogPageRepository)
    {
        $this->blogPageRepository = $blogPageRepository;
    }

    public function index()
    {
        $blogs = $this->blogPageRepository->getAllBlogs(); // Change 9 to the number of items you want per page

        return view('frontend.pages.blogs.list', compact('blogs'));
    }

    public function blogDetail($slug)
    {
        $blog = $this->blogPageRepository->getBlogDetail($slug);
        $relatedBlogs = $this->blogPageRepository->getRelatedBlog($blog->id, $blog->author_name);
        dd($relatedBlogs);
        $blogCategories = $this->blogPageRepository->getBlogCategories();
        return view('frontend.pages.blogs.detail', compact('blog', 'relatedBlogs','blogCategories'));
    }
}
