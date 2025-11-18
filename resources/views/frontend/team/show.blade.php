@extends('layouts.frontend')

@section('meta_title', $member->meta_title ?? $member->name)
@section('meta_description', $member->meta_description ?? Str::limit(strip_tags($member->bio), 150))
@section('meta_keywords', $member->meta_keywords ?? $member->name)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            @if($member->photo)
                <img src="{{ asset('storage/'.$member->photo) }}" class="rounded-circle mb-4" width="200" height="200" alt="{{ $member->name }}">
            @else
                <img src="https://via.placeholder.com/200x200?text=No+Image" class="rounded-circle mb-4" alt="No Image">
            @endif

            <h1>{{ $member->name }}</h1>
            <h4 class="text-muted">{{ $member->role ?? 'Team Member' }}</h4>

            @if($member->bio)
                <p class="mt-4">{{ $member->bio }}</p>
            @endif

            <a href="{{ route('team.index') }}" class="btn btn-outline-primary mt-4">← Back to Team</a>
        </div>
    </div>
</div>
@endsection
