<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\Product;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Podcast;
use App\Models\Testimonial;
use App\Models\About;

class HomeController extends Controller
{
    public function index()
    {
        $hero = Hero::first();
        $featuredProducts = Product::where('is_featured', true)->take(4)->get();
        $featuredServices = Service::where('is_featured', true)->take(4)->get();
        $recentBlogs = Blog::latest()->take(3)->get();
        $recentPodcasts = Podcast::latest()->take(2)->get();
        // HomeController@index
        $testimonials = Testimonial::where('is_featured', true)->latest()->take(8)->get();

        $about = About::first();

        return view('frontend.home', compact('hero', 'featuredProducts', 'featuredServices', 'recentBlogs', 'recentPodcasts', 'testimonials', 'about'));
    }
}
