<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(9);
        return view('frontend.blogs.index', compact('blogs'));
    }

    public function show($slug)
{
    $blog = Blog::with([])->where('slug', $slug)->firstOrFail();

    // If you have Category/Tag relations:
    $categories = \App\Models\Category::orderBy('name')->get() ?? collect();
    $recentPosts = Blog::latest()->take(3)->get();
    $allTags = \App\Models\Tag::orderBy('name')->get() ?? collect();

    return view('frontend.blogs.show', compact('blog','categories','recentPosts','allTags'));
}

}
