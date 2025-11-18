@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Tags</h1>
    <a href="{{ route('admin.tags.create') }}" class="btn btn-success mb-3">Add Tag</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->slug }}</td>
                    <td>
                        <a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete tag?')" type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">No tags found</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $tags->links() }}
</div>
@endsection
