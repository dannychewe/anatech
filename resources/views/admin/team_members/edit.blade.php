@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Edit Team Member</h1>

    <form action="{{ route('admin.team-members.update', $team_member->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name', $team_member->name) }}" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <input type="text" name="role" value="{{ old('role', $team_member->role) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Photo</label>
            <input type="file" name="photo" class="form-control">
            @if($team_member->photo)
                <p class="mt-2">
                    <img src="{{ asset('storage/'.$team_member->photo) }}" alt="Photo" width="150" class="rounded">
                </p>
            @endif
            @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Bio</label>
            <textarea name="bio" class="form-control">{{ old('bio', $team_member->bio) }}</textarea>
        </div>

        <h4>SEO Information</h4>
        <div class="mb-3">
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $team_member->meta_title) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" class="form-control">{{ old('meta_description', $team_member->meta_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Meta Keywords</label>
            <textarea name="meta_keywords" class="form-control">{{ old('meta_keywords', $team_member->meta_keywords) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.team-members.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
