<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatusUpdated;
use Maatwebsite\Excel\Facades\Excel; // if using Laravel Excel
use Barryvdh\DomPDF\Facade\Pdf; // if using barryvdh/laravel-dompdf

class BookingController extends Controller
{
    // Bookings list with filters
    public function index(Request $request)
    {
        $status = $request->get('status');
        $date = $request->get('date');

        $query = Booking::with(['product', 'service'])->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }
        if ($date) {
            $query->whereDate('start_date', '<=', $date)
                  ->whereDate('end_date', '>=', $date);
        }

        $bookings = $query->paginate(20);

        return view('admin.bookings.index', compact('bookings', 'status', 'date'));
    }

    // Show booking detail
    public function show($id)
    {
        $booking = Booking::with(['product', 'service'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    // Update status and optionally notify customer
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Confirmed,Completed,Cancelled'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        if ($request->has('notify') && $request->notify) {
            Mail::to($booking->customer_email)->send(new BookingStatusUpdated($booking));
        }

        return redirect()->route('admin.bookings.show', $booking->id)
                         ->with('success', 'Booking status updated successfully.');
    }

    // Export Bookings (CSV)
    public function exportCsv()
    {
        $bookings = Booking::with(['product', 'service'])->get();

        $csv = "ID,Customer,Email,Phone,Start Date,End Date,Status,Product/Service\n";
        foreach ($bookings as $b) {
            $linkedItem = $b->product ? $b->product->name : ($b->service ? $b->service->title : 'N/A');
            $csv .= "{$b->id},{$b->customer_name},{$b->customer_email},{$b->customer_phone},{$b->start_date},{$b->end_date},{$b->status},{$linkedItem}\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="bookings.csv"');
    }

    // Export Bookings (PDF)
    public function exportPdf()
    {
        $bookings = Booking::with(['product', 'service'])->get();
        $pdf = Pdf::loadView('admin.bookings.export-pdf', compact('bookings'));
        return $pdf->download('bookings.pdf');
    }
}
