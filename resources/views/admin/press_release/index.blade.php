@extends('admin.layouts.admin')

@section('title', 'Press Releases')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>All Press Releases</h4>
            <a href="{{ route('press-release.create') }}" class="btn btn-primary ml-auto">Add Press Release</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pressReleases as $item)
                        <tr>
                            <td>
                                @if($item->thumbnail_image)
                                    <img src="{{ asset('storage/' . $item->thumbnail_image) }}" width="50">
                                @endif
                            </td>
                            <td>{{ $item->title }}</td>
                            <td>{{ Str::limit($item->description, 50) }}</td>
                            <td>
                                <a href="{{ route('press-release.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('press-release.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this press release?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $pressReleases->links() }}
        </div>
    </div>
@endsection
