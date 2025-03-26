@extends('admin.layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>All News</h4>
            <a href="{{ route('news.create') }}" class="btn btn-primary ml-auto">Add News</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
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
                        @foreach ($news as $item)
                            <tr>
                                <td>
                                    @if($item->thumbnail_image)
                                        <img src="{{ asset('storage/' . $item->thumbnail_image) }}" width="50" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $item->title }}</td>
                                <td>{{ Str::limit($item->description, 50) }}</td>
                                <td>
                                    <a href="{{ route('news.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('news.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this news?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center">
                {{ $news->links() }}
            </div>
        </div>
    </div>
@endsection
