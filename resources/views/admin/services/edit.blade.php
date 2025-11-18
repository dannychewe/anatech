@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Service</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $service->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Base Price</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $service->price) }}" required>
        </div>


        <div class="mb-3">
            <label class="form-label">Slug (optional)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $service->slug) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control rich-text">
                {{ old('description', $service->description) }}
            </textarea>
        </div>


        <div class="mb-3">
            <label class="form-label">Service Icon</label>
            <input type="file" name="icon" class="form-control">
            @if($service->icon)
                <p class="mt-2">
                    <img src="{{ asset('storage/'.$service->icon) }}" alt="Service Icon" width="120">
                </p>
            @endif
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Service Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            @if(isset($service) && $service->image)
                <img src="{{ asset('storage/'.$service->image) }}" class="mt-2" height="100">
            @endif
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ $service->is_featured ? 'checked':'' }}>
            <label class="form-check-label">Mark as Featured</label>
        </div>

        <h4>SEO</h4>
        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $service->meta_title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control">{{ old('meta_description', $service->meta_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <textarea name="meta_keywords" class="form-control">{{ old('meta_keywords', $service->meta_keywords) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Service</button>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
