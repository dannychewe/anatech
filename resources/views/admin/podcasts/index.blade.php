@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Podcasts / Videos</h1>
    <a href="{{ route('admin.podcasts.create') }}" class="btn btn-success mb-3">Add Podcast / Video</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>Embed Preview</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($podcasts as $podcast)
                <tr>
                    <td>{{ $podcast->title }}</td>
                    <td>
                        <iframe src="{{ $podcast->embed_url }}" width="200" height="100" frameborder="0" allowfullscreen></iframe>
                    </td>
                    <td>
                        <a href="{{ route('admin.podcasts.edit', $podcast->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.podcasts.destroy', $podcast->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Delete this podcast/video?')" type="submit" class="btn btn-sm btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">No podcasts/videos found</td></tr>
            @endforelse
        </tbody>
    </table>

    {{ $podcasts->links() }}
</div>
@endsection
