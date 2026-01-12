@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Message Details</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Name:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Phone:</strong> {{ $contact->phone ?? '-' }}</p>
            <p><strong>Organization:</strong> {{ $contact->organization ?? '-' }}</p>
            <p><strong>Subject:</strong> {{ $contact->subject ?? '-' }}</p>
            <p><strong>Received:</strong> {{ $contact->created_at->format('M d, Y H:i') }}</p>
            <p><strong>Message:</strong></p>
            <p>{{ $contact->message }}</p>
        </div>
    </div>
    <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary mt-3">Back</a>
</div>
@endsection
