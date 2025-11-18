@extends('layouts.frontend')

@section('meta_title', $event->meta_title ?? $event->title)
@section('meta_description', $event->meta_description ?? '')
@section('meta_keywords', $event->meta_keywords ?? '')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">{{ $event->title }}</h1>
    
    @if($event->featured_image)
        <img src="{{ asset('storage/'.$event->featured_image) }}" class="img-fluid mb-4" alt="{{ $event->title }}">
    @endif

    @if($event->location)
        <p><strong>Location:</strong> {{ $event->location }}</p>
    @endif

    @if($event->start_date || $event->end_date)
        <p><strong>Date:</strong> 
            {{ $event->start_date ? $event->start_date->format('M d, Y') : '' }} 
            @if($event->end_date) - {{ $event->end_date->format('M d, Y') }} @endif
        </p>
    @endif

    <div class="mt-4">
        {!! $event->description !!}
    </div>
</div>
@endsection
