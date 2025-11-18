@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Events</h1>
    <a href="{{ route('admin.events.create') }}" class="btn btn-success mb-3">Add Event</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->start_date ? $event->start_date->format('Y-m-d H:i') : '-' }}</td>
                    <td>{{ $event->end_date ? $event->end_date->format('Y-m-d H:i') : '-' }}</td>
                    <td>
                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete event?')" type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No events found</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $events->links() }}
</div>
@endsection
