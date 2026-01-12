@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Add Product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug (optional)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="product_category_id" class="form-select" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (string) old('product_category_id') === (string) $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control rich-text">
                {{ old('description') }}
            </textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Features (one per line)</label>
            <textarea name="features" class="form-control" rows="5" placeholder="Feature 1&#10;Feature 2&#10;Feature 3">{{ old('features') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (optional)</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Currency (optional)</label>
            <select name="currency" class="form-select">
                <option value="">Select currency</option>
                <option value="ZMW" {{ old('currency') === 'ZMW' ? 'selected' : '' }}>ZMW - Zambia</option>
                <option value="CDF" {{ old('currency') === 'CDF' ? 'selected' : '' }}>CDF - DRC</option>
                <option value="MWK" {{ old('currency') === 'MWK' ? 'selected' : '' }}>MWK - Malawi</option>
                <option value="MZN" {{ old('currency') === 'MZN' ? 'selected' : '' }}>MZN - Mozambique</option>
                <option value="ZWL" {{ old('currency') === 'ZWL' ? 'selected' : '' }}>ZWL - Zimbabwe</option>
                <option value="AOA" {{ old('currency') === 'AOA' ? 'selected' : '' }}>AOA - Angola</option>
                <option value="ZAR" {{ old('currency') === 'ZAR' ? 'selected' : '' }}>ZAR - South Africa</option>
                <option value="BWP" {{ old('currency') === 'BWP' ? 'selected' : '' }}>BWP - Botswana</option>
                <option value="NAD" {{ old('currency') === 'NAD' ? 'selected' : '' }}>NAD - Namibia</option>
                <option value="USD" {{ old('currency') === 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Featured Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Gallery Images</label>
            <input type="file" name="images[]" class="form-control" multiple>
        </div>

        <div class="mb-3">
            <label class="form-label">Video URL (embed)</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url') }}">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked':'' }}>
            <label class="form-check-label">Mark as Featured</label>
        </div>

        <h4>SEO</h4>
        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <textarea name="meta_keywords" class="form-control">{{ old('meta_keywords') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Product</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
