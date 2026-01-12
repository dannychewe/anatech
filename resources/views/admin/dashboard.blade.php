@extends('layouts.admin')

@section('content')
@php
  $today = now()->format('F j, Y');
@endphp

<div class="dash-wrap">
  <div class="dash-hero mb-4 reveal">
    <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between position-relative">
      <div>
        <div class="dash-chip">Admin Overview</div>
        <h1 class="dash-title mt-3">Welcome back</h1>
        <p class="dash-subtitle">Here is a quick snapshot of your platform activity. {{ $today }}</p>
      </div>
      <div class="mt-3 mt-lg-0 d-flex gap-2">
        <a href="{{ route('admin.products.create') }}" class="btn btn-dark btn-sm">Add Product</a>
        <a href="{{ route('admin.product-categories.create') }}" class="btn btn-outline-dark btn-sm">Add Category</a>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-lg-3 col-sm-6 reveal" style="animation-delay: 0.05s;">
      <div class="kpi-card">
        <div class="kpi-label">Products</div>
        <div class="kpi-value">{{ $stats['products'] }}</div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6 reveal" style="animation-delay: 0.1s;">
      <div class="kpi-card">
        <div class="kpi-label">Product Categories</div>
        <div class="kpi-value">{{ $stats['product_categories'] }}</div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6 reveal" style="animation-delay: 0.15s;">
      <div class="kpi-card">
        <div class="kpi-label">Bookings</div>
        <div class="kpi-value">{{ $stats['bookings'] }}</div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6 reveal" style="animation-delay: 0.2s;">
      <div class="kpi-card">
        <div class="kpi-label">Subscribers</div>
        <div class="kpi-value">{{ $stats['subscribers'] }}</div>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-lg-4 reveal" style="animation-delay: 0.25s;">
      <a class="action-card" href="{{ route('admin.products.index') }}">
        <div class="action-title">Manage Products</div>
        <div>Update inventory, pricing, media, and SEO.</div>
      </a>
    </div>
    <div class="col-lg-4 reveal" style="animation-delay: 0.3s;">
      <a class="action-card secondary" href="{{ route('admin.product-categories.index') }}">
        <div class="action-title">Edit Categories</div>
        <div>Organize products under the right category.</div>
      </a>
    </div>
    <div class="col-lg-4 reveal" style="animation-delay: 0.35s;">
      <a class="action-card" href="{{ route('admin.bookings.index') }}">
        <div class="action-title">View Bookings</div>
        <div>Approve, manage, and export customer bookings.</div>
      </a>
    </div>
  </div>

  <div class="row g-3">
    <div class="col-lg-4 reveal" style="animation-delay: 0.4s;">
      <div class="panel-card h-100">
        <div class="panel-title">Latest Products</div>
        @forelse($latestProducts as $product)
          <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
            <div>
              <div class="fw-semibold">{{ $product->name }}</div>
              <small class="text-muted">{{ optional($product->category)->name ?? 'Uncategorized' }}</small>
            </div>
            <a class="btn btn-outline-dark btn-sm" href="{{ route('admin.products.edit', $product->id) }}">Edit</a>
          </div>
        @empty
          <div class="text-muted">No products yet.</div>
        @endforelse
      </div>
    </div>

    <div class="col-lg-4 reveal" style="animation-delay: 0.45s;">
      <div class="panel-card h-100">
        <div class="panel-title">Recent Bookings</div>
        @forelse($latestBookings as $booking)
          @php
            $status = strtolower($booking->status ?? 'pending');
            $badge = $status === 'approved' ? 'success' : ($status === 'rejected' ? 'danger' : 'secondary');
          @endphp
          <div class="d-flex align-items-center justify-content-between py-2 border-bottom">
            <div>
              <div class="fw-semibold">{{ $booking->customer_name ?? 'Guest' }}</div>
              <small class="text-muted">#{{ $booking->id }} • {{ $booking->created_at->format('M d') }}</small>
            </div>
            <span class="badge bg-{{ $badge }}">{{ ucfirst($status) }}</span>
          </div>
        @empty
          <div class="text-muted">No bookings yet.</div>
        @endforelse
      </div>
    </div>

    <div class="col-lg-4 reveal" style="animation-delay: 0.5s;">
      <div class="panel-card h-100">
        <div class="panel-title">New Messages</div>
        @forelse($latestContacts as $contact)
          <div class="py-2 border-bottom">
            <div class="fw-semibold">{{ $contact->name }}</div>
            <small class="text-muted">{{ $contact->subject ?? 'General Inquiry' }}</small>
          </div>
        @empty
          <div class="text-muted">No messages yet.</div>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection
