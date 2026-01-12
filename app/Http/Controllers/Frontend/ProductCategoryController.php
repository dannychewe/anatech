<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::latest()->paginate(12);

        return view('frontend.product-categories.index', compact('categories'));
    }

    public function show($slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();

        $products = $category->products()
            ->latest()
            ->paginate(12);

        return view('frontend.product-categories.show', compact('category', 'products'));
    }
}
