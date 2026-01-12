@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Brands</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary mb-3">Add Brand</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Name</th>
                <th>Website</th>
                <th>Sort Order</th>
                <th>Active</th>
                <th width="180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($brands as $brand)
                <tr>
                    <td>
                        @if($brand->logo)
                            <img src="{{ asset('storage/'.$brand->logo) }}" alt="{{ $brand->name }}" width="60" height="40" style="object-fit: contain;">
                        @else
                            <span class="text-muted">No logo</span>
                        @endif
                    </td>
                    <td>{{ $brand->name }}</td>
                    <td>
                        @if($brand->website_url)
                            <a href="{{ $brand->website_url }}" target="_blank">{{ $brand->website_url }}</a>
                        @else
                            <span class="text-muted">—</span>
                        @endif
                    </td>
                    <td>{{ $brand->sort_order }}</td>
                    <td>
                        @if($brand->is_active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-center">No brands found.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $brands->links() }}
</div>
@endsection