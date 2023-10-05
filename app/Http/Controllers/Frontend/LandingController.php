<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\FAQ;
use App\Models\Feature;
use App\Models\Sticker;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $features = Feature::orderBy('id', 'asc')->get(['id', 'name', 'short_description', 'image']);
        $faqs = FAQ::whereStatus('active')->orderBy('id', 'asc')->get(['name', 'short_description']);
        $blogs = Blog::whereStatus('active')->orderBy('id', 'asc')->get(['id', 'name', 'title', 'slug', 'image', 'created_at', 'author_name']);
        $stickers = Sticker::whereStatus('active')->orderBy('id', 'asc')->get(['image']);
        return view('frontend.pages.index', compact('features', 'faqs', 'blogs', 'stickers'));
    }

    public function faq()
    {
        $faqs = FAQ::whereStatus('active')->orderBy('id', 'asc')->get(['name', 'short_description']);
        return view('frontend.pages.faq', compact('faqs'));
    }
}
