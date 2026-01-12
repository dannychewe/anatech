@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Hero Section</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @php
            $heroImage = !empty($hero->background_image) ? asset('storage/'.$hero->background_image) : '';
        @endphp

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $hero->title ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $hero->subtitle ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Button Text</label>
            <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $hero->button_text ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Button Link</label>
            <input type="text" name="button_link" class="form-control" value="{{ old('button_link', $hero->button_link ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Background Image</label>
            <input type="file" name="background_image" class="form-control" data-existing-images="{{ $heroImage }}">
        </div>

        <h4>SEO</h4>
        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $hero->meta_title ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control">{{ old('meta_description', $hero->meta_description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <textarea name="meta_keywords" class="form-control">{{ old('meta_keywords', $hero->meta_keywords ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Hero</button>
    </form>
</div>
@endsection
