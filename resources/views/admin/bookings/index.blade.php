@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Bookings</h1>
    @php
        $exportQuery = request()->only(['status', 'date']);
    @endphp

    {{-- Filters --}}
    <form method="GET" class="row g-3 mb-3">
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">All Statuses</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="date" name="date" value="{{ request('date') }}" class="form-control">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100" type="submit">Filter</button>
        </div>
        <div class="col-md-2 ms-auto text-end">
            <a href="{{ route('admin.bookings.export.csv', $exportQuery) }}" class="btn btn-outline-success">Export CSV</a>
            <a href="{{ route('admin.bookings.export.pdf', $exportQuery) }}" class="btn btn-outline-danger">Export PDF</a>

        </div>
    </form>

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Linked To</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->customer_name }}</td>
                    <td>{{ $booking->customer_email }}</td>
                    <td>{{ $booking->customer_phone }}</td>
                    <td>{{ $booking->start_date }}</td>
                    <td>{{ $booking->end_date }}</td>
                    <td><span class="badge bg-info">{{ $booking->status }}</span></td>
                    <td>{{ $booking->currency ?? 'USD' }} {{ number_format((float) $booking->total_price, 2) }}</td>
                    <td>
                        @if($booking->product)
                            Product: {{ $booking->product->name }}
                        @elseif($booking->service)
                            Service: {{ $booking->service->title }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-primary">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">No bookings found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        {{ $bookings->links() }}
    </div>
</div>
@endsection
