@extends('layouts.frontend')

@section('meta_title', 'Our Team')
@section('meta_description', 'Meet our team members who make everything possible.')
@section('meta_keywords', 'team, staff, company')

@section('content')
<div class="container py-5">
    <h1 class="mb-4 text-center">Our Team</h1>

    <div class="row">
        @forelse($members as $member)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <a href="{{ route('team.show', $member->slug) }}">
                        @if($member->photo)
                            <img src="{{ asset('storage/'.$member->photo) }}" class="card-img-top" alt="{{ $member->name }}">
                        @else
                            <img src="https://via.placeholder.com/400x300?text=No+Image" class="card-img-top" alt="No Image">
                        @endif
                    </a>
                    <div class="card-body text-center">
                        <h5 class="card-title">
                            <a href="{{ route('team.show', $member->slug) }}" class="text-decoration-none text-dark">
                                {{ $member->name }}
                            </a>
                        </h5>
                        <p class="card-text text-muted">{{ $member->role ?? 'Team Member' }}</p>
                        @if($member->bio)
                            <p class="card-text small">{{ \Illuminate\Support\Str::limit($member->bio, 100) }}</p>
                        @endif
                        <a href="{{ route('team.show', $member->slug) }}" class="btn btn-outline-primary btn-sm mt-2">
                            View Profile
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No team members found.</p>
        @endforelse
    </div>
</div>
@endsection
