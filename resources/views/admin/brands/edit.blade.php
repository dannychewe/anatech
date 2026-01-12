@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Brand</h1>

    <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @php
            $logoUrl = $brand->logo ? asset('storage/'.$brand->logo) : '';
        @endphp

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $brand->name) }}" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" name="logo" class="form-control" accept="image/*" data-existing-images="{{ $logoUrl }}">
            @if($brand->logo)
                <div class="mt-2">
                    <img src="{{ $logoUrl }}" alt="Current logo" width="100" height="50" style="object-fit: contain;">
                    <small class="text-muted d-block">Current logo - upload a new one to replace</small>
                </div>
            @endif
            @error('logo') <small class="text-danger">{{ $message }}</small> @enderror
            <small class="text-muted">Recommended size: 200x100px, max 2MB</small>
        </div>

        <div class="mb-3">
            <label class="form-label">Website URL</label>
            <input type="url" name="website_url" value="{{ old('website_url', $brand->website_url) }}" class="form-control" placeholder="https://example.com">
            @error('website_url') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $brand->sort_order) }}" class="form-control" min="0">
            @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
            <small class="text-muted">Lower numbers appear first</small>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                {{ old('is_active', $brand->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Active</label>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection