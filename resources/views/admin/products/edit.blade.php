@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @php
            $featuredImage = $product->image ? asset('storage/'.$product->image) : '';
            $galleryImages = $product->images->map(function ($image) {
                return asset('storage/'.$image->path);
            })->implode(',');
        @endphp

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug (optional)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="product_category_id" class="form-select" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ (string) old('product_category_id', $product->product_category_id) === (string) $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control rich-text">
                {{ old('description', $product->description) }}
            </textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Features (one per line)</label>
            <textarea name="features" class="form-control" rows="5" placeholder="Feature 1&#10;Feature 2&#10;Feature 3">{{ old('features', $product->features->pluck('feature')->implode("\n")) }}</textarea>
        </div>


        <div class="mb-3">
            <label class="form-label">Price (optional)</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $product->price) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Currency (optional)</label>
            <select name="currency" class="form-select">
                <option value="">Select currency</option>
                <option value="ZMW" {{ old('currency', $product->currency) === 'ZMW' ? 'selected' : '' }}>ZMW - Zambia</option>
                <option value="CDF" {{ old('currency', $product->currency) === 'CDF' ? 'selected' : '' }}>CDF - DRC</option>
                <option value="MWK" {{ old('currency', $product->currency) === 'MWK' ? 'selected' : '' }}>MWK - Malawi</option>
                <option value="MZN" {{ old('currency', $product->currency) === 'MZN' ? 'selected' : '' }}>MZN - Mozambique</option>
                <option value="ZWL" {{ old('currency', $product->currency) === 'ZWL' ? 'selected' : '' }}>ZWL - Zimbabwe</option>
                <option value="AOA" {{ old('currency', $product->currency) === 'AOA' ? 'selected' : '' }}>AOA - Angola</option>
                <option value="ZAR" {{ old('currency', $product->currency) === 'ZAR' ? 'selected' : '' }}>ZAR - South Africa</option>
                <option value="BWP" {{ old('currency', $product->currency) === 'BWP' ? 'selected' : '' }}>BWP - Botswana</option>
                <option value="NAD" {{ old('currency', $product->currency) === 'NAD' ? 'selected' : '' }}>NAD - Namibia</option>
                <option value="USD" {{ old('currency', $product->currency) === 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Featured Image</label>
            <input type="file" name="image" class="form-control" data-existing-images="{{ $featuredImage }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Gallery Images</label>
            <input type="file" name="images[]" class="form-control" multiple data-existing-images="{{ $galleryImages }}">
            @if($product->images->count())
                <div id="gallerySortable" class="mt-3 d-flex flex-wrap gap-2" data-reorder-url="{{ route('admin.products.images.reorder', $product->id) }}">
                    @foreach($product->images as $image)
                        <div class="position-relative draggable-image" draggable="true" data-image-id="{{ $image->id }}">
                            <img src="{{ asset('storage/'.$image->path) }}" alt="Product Image" width="90" height="90" style="object-fit:cover;border-radius:10px;">
                            <div class="position-absolute bottom-0 start-0 w-100 text-center" style="background:rgba(0,0,0,0.5);color:#fff;font-size:10px;border-radius:0 0 10px 10px;cursor:grab;">Drag</div>
                            <button type="submit"
                                    class="btn btn-sm btn-danger position-absolute top-0 end-0"
                                    form="delete-image-{{ $image->id }}"
                                    onclick="return confirm('Remove this image?')"
                                    style="border-radius:999px;padding:2px 6px;line-height:1;">
                                &times;
                            </button>
                        </div>
                    @endforeach
                </div>
                <small class="text-muted d-block mt-2">Drag images to reorder.</small>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Video URL (embed)</label>
            <input type="url" name="video_url" class="form-control" value="{{ old('video_url', $product->video_url) }}">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked':'' }}>
            <label class="form-check-label">Mark as Featured</label>
        </div>

        <h4>SEO</h4>
        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $product->meta_title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control">{{ old('meta_description', $product->meta_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <textarea name="meta_keywords" class="form-control">{{ old('meta_keywords', $product->meta_keywords) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@if($product->images->count())
  @foreach($product->images as $image)
    <form id="delete-image-{{ $image->id }}" action="{{ route('admin.products.images.destroy', [$product->id, $image->id]) }}" method="POST" class="d-none">
      @csrf
      @method('DELETE')
    </form>
  @endforeach
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var container = document.getElementById('gallerySortable');
        if (!container) return;

        var dragged = null;

        container.addEventListener('dragstart', function (event) {
            var target = event.target.closest('.draggable-image');
            if (!target) return;
            dragged = target;
            target.style.opacity = '0.6';
        });

        container.addEventListener('dragend', function () {
            if (dragged) {
                dragged.style.opacity = '1';
            }
            dragged = null;
        });

        container.addEventListener('dragover', function (event) {
            event.preventDefault();
            var target = event.target.closest('.draggable-image');
            if (!target || target === dragged) return;
            var rect = target.getBoundingClientRect();
            var next = (event.clientX - rect.left) / rect.width > 0.5;
            container.insertBefore(dragged, next ? target.nextSibling : target);
        });

        container.addEventListener('drop', function (event) {
            event.preventDefault();
            var url = container.getAttribute('data-reorder-url');
            var token = document.querySelector('input[name="_token"]');
            var imageIds = Array.prototype.slice.call(container.querySelectorAll('.draggable-image'))
                .map(function (el) { return el.getAttribute('data-image-id'); });

            fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token ? token.value : ''
                },
                body: JSON.stringify({ image_ids: imageIds })
            });
        });
    });
</script>
</div>
@endsection
