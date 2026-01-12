<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatusUpdated;
use Barryvdh\DomPDF\Facade\Pdf; // if using barryvdh/laravel-dompdf

class BookingController extends Controller
{
    private function applyFilters(Request $request)
    {
        $status = $request->get('status');
        $date = $request->get('date');

        $query = Booking::with(['product', 'service'])->orderBy('created_at', 'desc');

        if ($status) {
            $query->where('status', $status);
        }
        if ($date) {
            $query->where(function ($q) use ($date) {
                $q->where(function ($qq) use ($date) {
                    $qq->whereDate('start_date', '<=', $date)
                       ->whereDate('end_date', '>=', $date);
                })->orWhere(function ($qq) use ($date) {
                    $qq->whereNull('start_date')
                       ->whereNull('end_date')
                       ->whereDate('created_at', $date);
                });
            });
        }

        return $query;
    }

    // Bookings list with filters
    public function index(Request $request)
    {
        $status = $request->get('status');
        $date = $request->get('date');
        $bookings = $this->applyFilters($request)->paginate(20);

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
            try {
                Mail::to($booking->customer_email)->send(new BookingStatusUpdated($booking));
            } catch (\Throwable $e) {
                report($e);
                return redirect()->route('admin.bookings.show', $booking->id)
                                 ->with('warning', "Status updated, but email couldn't be sent.");
            }
        }

        return redirect()->route('admin.bookings.show', $booking->id)
                         ->with('success', 'Booking status updated successfully.');
    }

    // Export Bookings (CSV)
    public function exportCsv(Request $request)
    {
        $bookings = $this->applyFilters($request)->get();

        return response()->streamDownload(function () use ($bookings) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, [
                'ID', 'Customer', 'Email', 'Phone', 'Start Date', 'End Date',
                'Status', 'Currency', 'Price/Unit', 'Total', 'Product/Service'
            ]);

            foreach ($bookings as $b) {
                $linkedItem = $b->product ? $b->product->name : ($b->service ? $b->service->title : 'N/A');
                fputcsv($handle, [
                    $b->id,
                    $b->customer_name,
                    $b->customer_email,
                    $b->customer_phone,
                    $b->start_date,
                    $b->end_date,
                    $b->status,
                    $b->currency ?? 'USD',
                    $b->price_per_unit,
                    $b->total_price,
                    $linkedItem,
                ]);
            }

            fclose($handle);
        }, 'bookings.csv', ['Content-Type' => 'text/csv']);
    }

    // Export Bookings (PDF)
    public function exportPdf(Request $request)
    {
        $bookings = $this->applyFilters($request)->get();
        $pdf = Pdf::loadView('admin.bookings.export-pdf', compact('bookings'));
        return $pdf->download('bookings.pdf');
    }
}
