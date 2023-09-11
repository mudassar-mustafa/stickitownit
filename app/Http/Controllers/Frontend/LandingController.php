<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\FAQ;
use App\Models\Feature;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('id', 'asc')->get(['id', 'name', 'short_description', 'image']);
        $faqs = FAQ::whereStatus('active')->orderBy('id', 'asc')->get(['name', 'short_description']);
        $blogs = Blog::whereStatus('active')->orderBy('id', 'asc')->get(['id', 'name', 'title', 'slug', 'image', 'created_at', 'author_name']);
        return view('frontend.pages.index', compact('features', 'faqs', 'blogs'));
    }
}
