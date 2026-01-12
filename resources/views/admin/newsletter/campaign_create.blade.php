@extends('layouts.admin')

@section('content')
<div class="container mt-4">
<h1>New Campaign</h1>

@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('warning'))
  <div class="alert alert-warning">{{ session('warning') }}</div>
@endif

<form method="POST" action="{{ route('admin.newsletter.campaigns.store') }}">
  @csrf
  <div class="mb-3">
    <label>Subject</label>
    <input name="subject" class="form-control" required value="{{ old('subject') }}">
    @error('subject') <small class="text-danger">{{ $message }}</small> @enderror
  </div>
  <div class="mb-3">
    <label>HTML Body</label>
    <textarea name="html" class="form-control" rows="10" required>{{ old('html') }}</textarea>
    @error('html') <small class="text-danger">{{ $message }}</small> @enderror
  </div>
  <div class="mb-3">
    <label>Plain Text (optional)</label>
    <textarea name="text" class="form-control" rows="6">{{ old('text') }}</textarea>
  </div>
  <button class="btn btn-primary">Send</button>
</form>
</div>
@endsection
