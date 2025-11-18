@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Services</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-success mb-3">Add Service</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Slug</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td>{{ $service->title }}</td>
                    <td>{{ $service->slug }}</td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete service?')" type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">No services found</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $services->links() }}
</div>
@endsection
