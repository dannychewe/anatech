@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Testimonials</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary mb-3">Add Testimonial</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Position</th>
                <th>Content</th>
                <th>Featured</th>
                <th width="180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $testimonial)
                <tr>
                    <td>
                        @if($testimonial->author_photo)
                            <img src="{{ asset('storage/'.$testimonial->author_photo) }}" alt="{{ $testimonial->author_name }}" width="60" class="rounded-circle">
                        @else
                            <span class="text-muted">No photo</span>
                        @endif
                    </td>
                    <td>{{ $testimonial->author_name }}</td>
                    <td>{{ $testimonial->author_position ?? '—' }}</td>
                    <td>{{ Str::limit($testimonial->content, 50) }}</td>
                    <td>
                        @if($testimonial->is_featured)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No testimonials found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $testimonials->links() }}
</div>
@endsection
