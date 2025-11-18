<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $q          = $request->get('q');
        $sort       = $request->get('sort', 'latest'); // latest | low | high
        $categoryId = $request->get('category');       // optional category filter

        // Load all categories for sidebar/filter
        $categories = ProductCategory::orderBy('name')->get();

        $query = Product::with('category');

        // Search filter
        if ($q) {
            $query->where(function ($qq) use ($q) {
                $qq->where('name', 'like', "%{$q}%")
                   ->orWhere('description', 'like', "%{$q}%");
            });
        }

        // Category filter
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        // Sorting
        switch ($sort) {
            case 'low':
                $query->orderBy('price', 'asc')->orderBy('created_at', 'desc');
                break;

            case 'high':
                $query->orderBy('price', 'desc')->orderBy('created_at', 'desc');
                break;

            default: // latest
                $query->latest();
        }

        $products = $query->paginate(12)->appends($request->only('q', 'sort', 'category'));

        return view('frontend.products.index', compact(
            'products',
            'q',
            'sort',
            'categories',
            'categoryId'
        ));
    }

    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        // Optional: get related products (same category)
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(6)
            ->get();

        return view('frontend.products.show', compact('product', 'related'));
    }
}
