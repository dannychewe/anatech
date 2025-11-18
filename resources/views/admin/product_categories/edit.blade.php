@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Category</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.product_categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <div class="mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" 
                   name="name" 
                   class="form-control" 
                   value="{{ old('name', $category->name) }}" 
                   required>
        </div>

        {{-- Slug --}}
        <div class="mb-3">
            <label class="form-label">Slug (optional)</label>
            <input type="text" 
                   name="slug" 
                   class="form-control" 
                   value="{{ old('slug', $category->slug) }}">
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" 
                      class="form-control" 
                      rows="4">{{ old('description', $category->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
        <a href="{{ route('admin.product_categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
