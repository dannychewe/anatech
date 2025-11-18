@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" 
          method="POST" 
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- CATEGORY --}}
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-control">
                <option value="">-- Select Category --</option>

                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- NAME --}}
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" 
                   name="name" 
                   class="form-control" 
                   value="{{ old('name', $product->name) }}" 
                   required>
        </div>

        {{-- SLUG --}}
        <div class="mb-3">
            <label class="form-label">Slug (optional)</label>
            <input type="text" 
                   name="slug" 
                   class="form-control" 
                   value="{{ old('slug', $product->slug) }}">
        </div>

        {{-- DESCRIPTION --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" 
                      class="form-control rich-text">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- PRICE --}}
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" 
                   step="0.01" 
                   name="price" 
                   class="form-control" 
                   value="{{ old('price', $product->price) }}">
        </div>

        {{-- IMAGE --}}
        <div class="mb-3">
            <label class="form-label">Featured Image</label>
            <input type="file" name="image" class="form-control">

            @if($product->image)
                <p class="mt-2">
                    <img src="{{ asset('storage/'.$product->image) }}" 
                         alt="Product Image" 
                         width="120">
                </p>
            @endif
        </div>

        {{-- FEATURED --}}
        <div class="form-check mb-3">
            <input class="form-check-input" 
                   type="checkbox" 
                   name="is_featured" 
                   value="1" 
                   {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
            <label class="form-check-label">Mark as Featured</label>
        </div>

        <h4>SEO</h4>

        {{-- META TITLE --}}
        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" 
                   name="meta_title" 
                   class="form-control" 
                   value="{{ old('meta_title', $product->meta_title) }}">
        </div>

        {{-- META DESCRIPTION --}}
        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" 
                      class="form-control">{{ old('meta_description', $product->meta_description) }}</textarea>
        </div>

        {{-- META KEYWORDS --}}
        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <textarea name="meta_keywords" 
                      class="form-control">{{ old('meta_keywords', $product->meta_keywords) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
