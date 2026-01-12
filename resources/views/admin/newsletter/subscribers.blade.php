@extends('layouts.admin')

@section('content')
<div class="container mt-4">
  <h1>Subscribers</h1>

  @php
    $exportQuery = request()->only(['status', 'q']);
  @endphp

  <form method="GET" class="row g-3 mb-3">
    <div class="col-md-4">
      <input type="text" name="q" class="form-control" placeholder="Search email or name" value="{{ request('q') }}">
    </div>
    <div class="col-md-3">
      <select name="status" class="form-select">
        <option value="">All Statuses</option>
        <option value="subscribed" {{ request('status') === 'subscribed' ? 'selected' : '' }}>Subscribed</option>
        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="unsubscribed" {{ request('status') === 'unsubscribed' ? 'selected' : '' }}>Unsubscribed</option>
      </select>
    </div>
    <div class="col-md-2">
      <button class="btn btn-primary w-100" type="submit">Filter</button>
    </div>
    <div class="col-md-3 text-end ms-auto">
      <a href="{{ route('admin.newsletter.export.csv', $exportQuery) }}" class="btn btn-outline-success">Export CSV</a>
      <a href="{{ route('admin.newsletter.export.pdf', $exportQuery) }}" class="btn btn-outline-danger">Export PDF</a>
    </div>
  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Email</th>
        <th>Name</th>
        <th>Status</th>
        <th>Subscribed</th>
        <th>Unsubscribed</th>
      </tr>
    </thead>
    <tbody>
      @forelse($subs as $s)
        <tr>
          <td>{{ $s->email }}</td>
          <td>{{ $s->name }}</td>
          <td>
            <span class="badge bg-{{ $s->status === 'subscribed' ? 'success' : ($s->status === 'pending' ? 'warning' : 'secondary') }}">
              {{ ucfirst($s->status) }}
            </span>
          </td>
          <td>{{ optional($s->subscribed_at)->toDayDateTimeString() ?? '-' }}</td>
          <td>{{ optional($s->unsubscribed_at)->toDayDateTimeString() ?? '-' }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="text-center">No subscribers found</td>
        </tr>
      @endforelse
    </tbody>
  </table>
  {{ $subs->links() }}
</div>
@endsection
