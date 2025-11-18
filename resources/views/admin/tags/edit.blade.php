@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Tag</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Tag Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $tag->name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug (optional)</label>
            <input type="text" name="slug" class="form-control" value="{{ old('slug', $tag->slug) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Tag</button>
        <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
