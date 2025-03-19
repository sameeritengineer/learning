@extends('admin.layouts.admin')

@section('content')
    <section class="section">
    	<div class="section-header">
            <h1>Blog Posts</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Blog Posts</div>
            </div>
        </div>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Add Blog</a>

<table class="table">
    <tr>
        <th>#</th>
        <th>Thumbnail</th>
        <th>Title</th>
        <th>Status</th>
        <th>Featured</th>
        <th>Actions</th>
    </tr>
    @foreach($blogs as $index => $blog)
        <tr>
            <td>{{ $index + 1 }}</td> <!-- Numbering -->
            <td>
                @if($blog->thumbnail_image)
                    <img src="{{ asset('storage/' . $blog->thumbnail_image) }}" width="50" height="50" alt="Thumbnail">
                @else
                    <span>No Image</span>
                @endif
            </td>
            <td>{{ $blog->title }}</td>
            <td>
                <span class="badge {{ $blog->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                    {{ ucfirst($blog->status) }}
                </span>
            </td>
            <td>
                @if($blog->is_featured)
                    <span class="badge bg-primary">Featured</span>
                @else
                    <span class="badge bg-secondary">Not Featured</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('admin.blog.delete', $blog->id) }}" class="btn btn-danger" 
                   onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    @endforeach
</table>

</section>
@endsection
