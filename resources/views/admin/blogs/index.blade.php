@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Blogs</h1>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-success mb-3">Add Blog</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Published</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>{{ $blog->category?->name ?? '-' }}</td>
                    <td>{{ $blog->published_at ? $blog->published_at->format('Y-m-d') : '-' }}</td>
                    <td>
                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete blog?')" type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">No blogs found</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $blogs->links() }}
</div>
@endsection
