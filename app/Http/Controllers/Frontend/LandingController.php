<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FAQ;
use App\Models\Feature;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $categories = Category::whereStatus('active')->orderBy('id', 'asc')->get(['id', 'name', 'slug', 'image']);
        $features = Feature::
        orderBy('id', 'asc')->get(['id', 'name', 'short_description', 'image']);
        $faqs = FAQ::whereStatus('active')->orderBy('id', 'asc')->get(['name', 'short_description']);
        return view('frontend.pages.index', compact('categories', 'features', 'faqs'));
    }
}
