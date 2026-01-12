<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Blog;
use App\Models\Podcast;
use App\Models\Testimonial;
use App\Models\About;
use App\Models\Brand;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        $productCategories = ProductCategory::withCount('products')->orderBy('name')->take(6)->get();
        $recentBlogs = Blog::latest()->take(3)->get();
        $recentPodcasts = Podcast::latest()->take(2)->get();
        // HomeController@index
        $testimonials = Testimonial::where('is_featured', true)->latest()->take(8)->get();
        $brands = Brand::where('is_active', true)->orderBy('sort_order')->get();

        $about = About::first();

        return view('frontend.home', compact('hero', 'productCategories', 'recentBlogs', 'recentPodcasts', 'testimonials', 'about', 'brands'));
    }
}
