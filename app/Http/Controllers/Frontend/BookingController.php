<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingReceived;
use App\Mail\BookingConfirmation;
use Illuminate\Validation\Rule;
class BookingController extends Controller
{
    public function create(Request $request)
    {
        $product = Product::find($request->get('product_id'));
        $service = Service::find($request->get('service_id'));

        // Guard: if a service is passed but not featured, bounce back
        if ($service && !$service->is_featured) {
            return redirect()
                ->route('services.show', $service->slug)
                ->with('warning', 'This service is not available for online booking.');
        }

        return view('frontend.bookings.create', compact('product', 'service'));
    }

    public function store(Request $request)
{
    $request->validate([
        'customer_name'  => ['required','string','max:255','regex:/^[\pL\s\-\'\.]+$/u'],
        'customer_email' => 'required|email:rfc,dns',
        'customer_phone' => ['nullable','regex:/^[0-9\-\+\s\(\)]+$/','max:20'],
        'location'       => ['nullable','string','max:255','regex:/^[\pL0-9\s\-\.,#]+$/u'],
        'notes'          => ['nullable','string','max:500','regex:/^[\pL0-9\s\-\.,#\(\)\/]+$/u'],
        'service_id'     => ['nullable','integer','exists:services,id'],
        'product_id'     => ['nullable','integer','exists:products,id'],

        // Dates: required only if it's a service booking
        'start_date'     => [
            Rule::requiredIf(fn () => $request->filled('service_id')),
            'nullable', 'date'
        ],
        'end_date'       => [
            Rule::requiredIf(fn () => $request->filled('service_id')),
            'nullable', 'date', 'after_or_equal:start_date'
        ],
    ]);

    // Enforce: only featured services/products can be booked
    if ($request->filled('service_id')) {
        $service = Service::find($request->service_id);
        if (!$service || !$service->is_featured) {
            return back()->withInput()->with('warning', 'This service is not available for online booking.');
        }
    }
    if ($request->filled('product_id')) {
        $product = Product::find($request->product_id);
        if (!$product || !$product->is_featured) {
            return back()->withInput()->with('warning', 'This product is not available for online ordering.');
        }
    }

    // Price (nullable is fine)
    $pricePerUnit = 0;
    if ($request->filled('service_id')) {
        $pricePerUnit = optional(Service::find($request->service_id))->price ?? 0;
    }
    if ($request->filled('product_id')) {
        $pricePerUnit = optional(Product::find($request->product_id))->price ?? 0;
    }

    // Totals
    $isService = $request->filled('service_id');
    $days = $isService
        ? \Carbon\Carbon::parse($request->start_date)->diffInDays(\Carbon\Carbon::parse($request->end_date)) + 1
        : 1;

    $quantity   = max(1, (int) ($request->quantity ?? 1));
    $totalPrice = $pricePerUnit * $quantity * $days;

    // Create booking (dates only for services)
    $booking = Booking::create([
        'product_id'     => $request->product_id,
        'service_id'     => $request->service_id,
        'customer_name'  => $request->customer_name,
        'customer_email' => $request->customer_email,
        'customer_phone' => $request->customer_phone,
        'location'       => $request->location,
        'quantity'       => $quantity,
        'price_per_unit' => $pricePerUnit,
        'total_price'    => $totalPrice,
        'start_date'     => $isService ? $request->start_date : null,
        'end_date'       => $isService ? $request->end_date   : null,
        'notes'          => $request->notes,
        'status'         => 'Pending',
    ]);

    // Emails (don’t block success)
    $warnings = [];
    $adminTo = env('MAIL_ADMIN_ADDRESS', config('mail.from.address'));

    try {
        if ($adminTo) {
            Mail::to($adminTo)->send(new BookingReceived($booking));
        } else {
            $warnings[] = 'Admin email is not configured.';
        }
    } catch (\Throwable $e) {
        report($e);
        $warnings[] = "Couldn't notify the admin by email.";
    }

    try {
        Mail::to($booking->customer_email)->send(new BookingConfirmation($booking));
    } catch (\Throwable $e) {
        report($e);
        $warnings[] = "Couldn't send your confirmation email.";
    }

    // Redirect back to detail page where possible
    $redirectTo = url()->previous();
    if ($booking->service_id && ($svc = Service::find($booking->service_id))) {
        $redirectTo = route('services.show', $svc->slug);
    } elseif ($booking->product_id && ($prod = Product::find($booking->product_id))) {
        if (\Illuminate\Support\Facades\Route::has('products.show')) {
            $redirectTo = route('products.show', $prod->slug);
        }
    }

    return redirect($redirectTo)
        ->with('success', 'Booking successfully submitted!')
        ->with($warnings ? ['warning' => implode(' ', array_unique($warnings))] : []);
}

    public function success()
    {
        return view('frontend.bookings.success');
    }
}
