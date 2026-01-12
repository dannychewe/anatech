@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Testimonial</h1>

    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @php
            $authorPhoto = $testimonial->author_photo ? asset('storage/'.$testimonial->author_photo) : '';
        @endphp

        <div class="mb-3">
            <label class="form-label">Author Name</label>
            <input type="text" name="author_name" value="{{ old('author_name', $testimonial->author_name) }}" class="form-control" required>
            @error('author_name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Author Position</label>
            <input type="text" name="author_position" value="{{ old('author_position', $testimonial->author_position) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Author Photo</label>
            <input type="file" name="author_photo" class="form-control" data-existing-images="{{ $authorPhoto }}">
            @error('author_photo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" class="form-control" rows="4" required>{{ old('content', $testimonial->content) }}</textarea>
            @error('content') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="is_featured"
                {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_featured">Featured</label>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
