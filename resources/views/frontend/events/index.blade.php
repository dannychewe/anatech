@extends('layouts.frontend')

@section('meta_title', 'Events')
@section('meta_description', 'Check out our upcoming events.')
@section('meta_keywords', 'events')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Events</h1>
    <div class="row">
        @forelse($events as $event)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <a href="{{ route('events.show', $event->slug) }}">
                        @if($event->featured_image)
                            <img src="{{ asset('storage/'.$event->featured_image) }}" class="card-img-top" alt="{{ $event->title }}">
                        @else
                            <img src="https://via.placeholder.com/600x400?text=No+Image" class="card-img-top" alt="No Image">
                        @endif
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('events.show', $event->slug) }}" class="text-decoration-none">
                                {{ $event->title }}
                            </a>
                        </h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($event->description), 100) }}</p>
                        @if($event->start_date)
                            <p><strong>Start:</strong> {{ $event->start_date }}</p>
                        @endif
                        @if($event->location)
                            <p><strong>Location:</strong> {{ $event->location }}</p>
                        @endif
                        <a href="{{ route('events.show', $event->slug) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <p>No events available.</p>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $events->links() }}
    </div>
</div>
@endsection
