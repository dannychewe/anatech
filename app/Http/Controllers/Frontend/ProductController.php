<?php

// app/Http/Controllers/Frontend/ProductController.php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q    = $request->get('q');
        $sort = $request->get('sort', 'latest'); // latest

        $query = ProductCategory::withCount('products');

        if ($q) {
            $query->where(function ($qq) use ($q) {
                $qq->where('name', 'like', "%{$q}%")
                   ->orWhere('description', 'like', "%{$q}%");
            });
        }

        $query->latest();

        $categories = $query->paginate(12)->appends($request->only('q','sort'));

        return view('frontend.products.index', compact('categories', 'q', 'sort'));
    }

    public function show($slug)
    {
        $product = Product::with(['images', 'category', 'features'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with('category')
            ->when($product->product_category_id, function ($query) use ($product) {
                $query->where('product_category_id', $product->product_category_id);
            })
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        if ($relatedProducts->isEmpty()) {
            $relatedProducts = Product::with('category')
                ->where('id', '!=', $product->id)
                ->latest()
                ->take(4)
                ->get();
        }

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }
}
