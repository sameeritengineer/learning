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

        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($blog) ? 'Edit Blog' : 'Create Blog' }}</h4>
                    </div>
                    <div class="card-body">

                        <!-- Show Validation Errors at the Top -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ isset($blog) ? route('admin.blog.update', $blog->id) : route('admin.blog.store') }}" 
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($blog))
                                @method('POST')
                            @endif

                            <!-- Title -->
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $blog->title ?? '') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Mini Description -->
                            <div class="form-group">
                                <label for="mini_description">Mini Description:</label>
                                <textarea name="mini_description" id="mini_summernote" class="form-control @error('mini_description') is-invalid @enderror">{{ old('mini_description', $blog->mini_description ?? '') }}</textarea>
                                @error('mini_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $blog->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="form-group">
                                <label for="category_id">Category:</label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Cover Image -->
                            <div class="form-group">
                                <label for="cover_image">Cover Image:</label>
                                <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                                @error('cover_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(isset($blog) && $blog->cover_image)
                                    <img src="{{ asset('storage/' . $blog->cover_image) }}" width="100" class="mt-2">
                                @endif
                            </div>

                            <!-- Thumbnail Image -->
                            <div class="form-group">
                                <label for="thumbnail_image">Thumbnail Image:</label>
                                <input type="file" name="thumbnail_image" id="thumbnail_image" class="form-control @error('thumbnail_image') is-invalid @enderror">
                                @error('thumbnail_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(isset($blog) && $blog->thumbnail_image)
                                    <img src="{{ asset('storage/' . $blog->thumbnail_image) }}" width="100" class="mt-2">
                                @endif
                            </div>

                            <!-- Status -->
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active" {{ old('status', $blog->status ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $blog->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Is Featured -->
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="is_featured" id="is_featured" class="custom-control-input" value="1" 
                                        {{ old('is_featured', $blog->is_featured ?? false) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_featured">Featured</label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ isset($blog) ? 'Update' : 'Create' }} Blog
                                </button>
                                <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/modules/summernote/summernote-bs4.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('admin/modules/summernote/summernote-bs4.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#summernote, #mini_summernote').summernote({
                height: 300,
                minHeight: 200,
                maxHeight: 500,
                focus: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
@endpush
