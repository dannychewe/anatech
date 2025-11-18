@extends('layouts.frontend')

@section('meta_title', 'Testimonials')
@section('meta_description', 'What our clients say about us.')
@section('meta_keywords', 'testimonials, reviews, clients')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">What Our Clients Say</h1>

    <div class="row">
        @forelse($testimonials as $testimonial)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm text-center p-4">
                    @if($testimonial->author_photo)
                        <img src="{{ asset('storage/'.$testimonial->author_photo) }}" 
                             alt="{{ $testimonial->author_name }}" 
                             class="rounded-circle mb-3" width="80" height="80">
                    @else
                        <img src="https://via.placeholder.com/80x80?text=No+Image" 
                             alt="No Image" 
                             class="rounded-circle mb-3">
                    @endif
                    <blockquote class="blockquote">
                        <p class="mb-0">"{{ $testimonial->content }}"</p>
                    </blockquote>
                    <footer class="blockquote-footer mt-3">
                        <strong>{{ $testimonial->author_name }}</strong>
                        @if($testimonial->author_position)
                            <span class="d-block text-muted">{{ $testimonial->author_position }}</span>
                        @endif
                    </footer>
                </div>
            </div>
        @empty
            <p class="text-center">No testimonials available.</p>
        @endforelse
    </div>
</div>
@endsection
