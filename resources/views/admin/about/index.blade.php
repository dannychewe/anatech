@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>About Us Settings</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @php
            $aboutImage = !empty($about->image) ? asset('storage/'.$about->image) : '';
        @endphp

        {{-- Title --}}
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $about->title ?? '') }}">
        </div>

        {{-- Image --}}
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" data-existing-images="{{ $aboutImage }}">
        </div>

        {{-- Content --}}
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" class="form-control rich-text" rows="4">
                    {{ old('content', $about->content ?? '') }}
                </textarea>
            </div>

            {{-- Vision --}}
            <div class="mb-3">
                <label class="form-label">Vision</label>
                <textarea name="vision" class="form-control rich-text" rows="3">
                    {{ old('vision', $about->vision ?? '') }}
                </textarea>
            </div>

            {{-- Mission --}}
            <div class="mb-3">
                <label class="form-label">Mission</label>
                <textarea name="mission" class="form-control rich-text" rows="3">
                    {{ old('mission', $about->mission ?? '') }}
                </textarea>
            </div>

            {{-- Why Choose Us --}}
            <div class="mb-3">
                <label class="form-label">Why Choose Us</label>
                <textarea name="why_choose_us" class="form-control rich-text" rows="3">
                    {{ old('why_choose_us', $about->why_choose_us ?? '') }}
                </textarea>
            </div>


        <h4 class="mt-4">SEO</h4>
        {{-- Meta Title --}}
        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $about->meta_title ?? '') }}">
        </div>

        {{-- Meta Description --}}
        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control" rows="2">{{ old('meta_description', $about->meta_description ?? '') }}</textarea>
        </div>

        {{-- Meta Keywords --}}
        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <textarea name="meta_keywords" class="form-control" rows="2">{{ old('meta_keywords', $about->meta_keywords ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
