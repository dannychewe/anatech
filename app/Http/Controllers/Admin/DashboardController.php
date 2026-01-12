<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\NewsletterSubscriber;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::count(),
            'product_categories' => ProductCategory::count(),
            'services' => Service::count(),
            'blogs' => Blog::count(),
            'bookings' => Booking::count(),
            'contacts' => Contact::count(),
            'subscribers' => NewsletterSubscriber::count(),
        ];

        $latestProducts = Product::with('category')->latest()->take(5)->get();
        $latestBookings = Booking::latest()->take(5)->get();
        $latestContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestProducts', 'latestBookings', 'latestContacts'));
    }
}
