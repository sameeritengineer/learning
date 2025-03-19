@extends('admin.layouts.admin')

@section('content')
    <section class="section">
    	<div class="section-header">
            <h1>{{ isset($blog) ? 'Edit Blog' : 'Create Blog' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">{{ isset($blog) ? 'Edit Blog' : 'Create Blog' }}</div>
            </div>
        </div>

        <form action="{{ isset($blog) ? route('admin.blog.update', $blog->id) : route('admin.blog.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($blog))
                @method('POST')
            @endif

            <!-- Title -->
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title ?? '') }}" required>
            </div>

            <!-- Mini Description -->
            <div class="form-group">
                <label for="mini_description">Mini Description:</label>
                <input type="text" name="mini_description" id="mini_description" class="form-control" 
                       value="{{ old('mini_description', $blog->mini_description ?? '') }}">
            </div>

            <!-- Description -->
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control" rows="5" required>{{ old('description', $blog->description ?? '') }}</textarea>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select name="category_id" id="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ isset($blog) && $blog->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Cover Image -->
            <div class="form-group">
                <label for="cover_image">Cover Image:</label>
                <input type="file" name="cover_image" id="cover_image" class="form-control">
                @if(isset($blog) && $blog->cover_image)
                    <img src="{{ asset('storage/' . $blog->cover_image) }}" width="100" class="mt-2">
                @endif
            </div>

            <!-- Thumbnail Image -->
            <div class="form-group">
                <label for="thumbnail_image">Thumbnail Image:</label>
                <input type="file" name="thumbnail_image" id="thumbnail_image" class="form-control">
                @if(isset($blog) && $blog->thumbnail_image)
                    <img src="{{ asset('storage/' . $blog->thumbnail_image) }}" width="100" class="mt-2">
                @endif
            </div>

            <!-- Status -->
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" {{ isset($blog) && $blog->status == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ isset($blog) && $blog->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Is Featured -->
            <div class="form-group">
                <label>
                    <input type="checkbox" name="is_featured" value="1" 
                        {{ isset($blog) && $blog->is_featured ? 'checked' : '' }}>
                    Featured
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-success">
                {{ isset($blog) ? 'Update' : 'Create' }} Blog
            </button>

            <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </section>
@endsection
