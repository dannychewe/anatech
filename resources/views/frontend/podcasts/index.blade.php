@extends('layouts.frontend')

@section('meta_title', 'Podcasts')
@section('meta_description', 'Listen to our podcasts.')
@section('meta_keywords', 'podcasts')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Podcasts</h1>
    <div class="row">
        @forelse($podcasts as $podcast)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('podcasts.show', $podcast->slug) }}">
                        @if($podcast->thumbnail)
                            <img src="{{ asset('storage/'.$podcast->thumbnail) }}" class="card-img-top" alt="{{ $podcast->title }}">
                        @else
                            <img src="https://via.placeholder.com/600x400?text=No+Image" class="card-img-top" alt="No Image">
                        @endif
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('podcasts.show', $podcast->slug) }}" class="text-decoration-none">
                                {{ $podcast->title }}
                            </a>
                        </h5>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($podcast->description), 100) }}</p>
                        <a href="{{ route('podcasts.show', $podcast->slug) }}" class="btn btn-sm btn-outline-primary mt-2">
                            View Details
                        </a>
                        <div class="ratio ratio-16x9 mt-3">
                            {!! $podcast->embed_url !!}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p>No podcasts found.</p>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $podcasts->links() }}
    </div>
</div>
@endsection
