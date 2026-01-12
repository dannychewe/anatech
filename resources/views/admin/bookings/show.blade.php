@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Booking #{{ $booking->id }}</h1>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Customer:</strong> {{ $booking->customer_name }}</p>
            <p><strong>Email:</strong> {{ $booking->customer_email }}</p>
            <p><strong>Phone:</strong> {{ $booking->customer_phone }}</p>
            <p><strong>Location:</strong> {{ $booking->location }}</p>
            <p><strong>Quantity:</strong> {{ $booking->quantity }}</p>
            <p><strong>Start Date:</strong> {{ $booking->start_date }}</p>
            <p><strong>End Date:</strong> {{ $booking->end_date }}</p>
            <p><strong>Price Per Unit:</strong> {{ $booking->currency ?? 'USD' }} {{ number_format((float) $booking->price_per_unit, 2) }}</p>
            <p><strong>Total:</strong> {{ $booking->currency ?? 'USD' }} {{ number_format((float) $booking->total_price, 2) }}</p>
            <p><strong>Notes:</strong> {{ $booking->notes ?? 'None' }}</p>
            <p><strong>Status:</strong> 
                <span class="badge bg-info">{{ $booking->status }}</span>
            </p>
            <p><strong>Linked To:</strong>
                @if($booking->product)
                    Product: {{ $booking->product->name }}
                @elseif($booking->service)
                    Service: {{ $booking->service->title }}
                @else
                    N/A
                @endif
            </p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Update Status</div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.bookings.updateStatus', $booking->id) }}">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Confirmed" {{ $booking->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Completed" {{ $booking->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-check mt-2">
                        <input type="checkbox" name="notify" value="1" class="form-check-input" id="notifyCheck">
                        <label class="form-check-label" for="notifyCheck">Notify Customer</label>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-success">Update Status</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
