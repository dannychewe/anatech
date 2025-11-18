@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Footer Settings</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.footer.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $footer->phone ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $footer->email ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control">{{ old('address', $footer->address ?? '') }}</textarea>
        </div>

        <h4>Social Links</h4>
        <div class="mb-3">
            <label class="form-label">Facebook</label>
            <input type="url" name="facebook" class="form-control" value="{{ old('facebook', $footer->facebook ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Twitter</label>
            <input type="url" name="twitter" class="form-control" value="{{ old('twitter', $footer->twitter ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">LinkedIn</label>
            <input type="url" name="linkedin" class="form-control" value="{{ old('linkedin', $footer->linkedin ?? '') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Instagram</label>
            <input type="url" name="instagram" class="form-control" value="{{ old('instagram', $footer->instagram ?? '') }}">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
