@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Podcast</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.podcasts.update', $podcast->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @php
            $thumbnail = $podcast->thumbnail ? asset('storage/'.$podcast->thumbnail) : '';
        @endphp

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $podcast->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug (optional)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $podcast->slug) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Embed URL</label>
            <input type="text" name="embed_url" class="form-control" value="{{ old('embed_url', $podcast->embed_url) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control" data-existing-images="{{ $thumbnail }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control rich-text">
                {{ old('description', $podcast->description) }}
            </textarea>
        </div>

        <h4>SEO</h4>
        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $podcast->meta_title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control">{{ old('meta_description', $podcast->meta_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <textarea name="meta_keywords" class="form-control">{{ old('meta_keywords', $podcast->meta_keywords) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Podcast</button>
        <a href="{{ route('admin.podcasts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
