@extends('admin.layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($news) ? 'Edit News' : 'Create News' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">{{ isset($news) ? 'Edit News' : 'Create News' }}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($news) ? 'Edit News' : 'Create News' }}</h4>
                    </div>
                    <div class="card-body">

                        <!-- Show Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ isset($news) ? route('news.update', $news->id) : route('news.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($news)) @method('PUT') @endif

                            <!-- Title -->
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $news->title ?? '') }}" required>
                                @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $news->description ?? '') }}</textarea>
                                @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <!-- Whole News -->
                            <div class="form-group">
                                <label>Whole News</label>
                                <textarea name="whole_news" id="summernote" class="form-control @error('whole_news') is-invalid @enderror" required>{{ old('whole_news', $news->whole_news ?? '') }}</textarea>
                                @error('whole_news') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <!-- Thumbnail Image -->
                            <div class="form-group">
                                <label>Thumbnail Image</label>
                                <input type="file" name="thumbnail_image" class="form-control">
                                @if(isset($news) && $news->thumbnail_image)
                                    <br>
                                    <img src="{{ asset('storage/' . $news->thumbnail_image) }}" width="100" class="mt-2">
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ isset($news) ? 'Update' : 'Create' }} News
                                </button>
                                <a href="{{ route('news.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
