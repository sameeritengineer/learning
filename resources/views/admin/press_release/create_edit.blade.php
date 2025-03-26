@extends('admin.layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($pressRelease) ? 'Edit Press Release' : 'Create Press Release' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">{{ isset($pressRelease) ? 'Edit Press Release' : 'Create Press Release' }}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($pressRelease) ? 'Edit Press Release' : 'Create Press Release' }}</h4>
                    </div>
                    <div class="card-body">

                        <!-- Show Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ isset($pressRelease) ? route('press-release.update', $pressRelease->id) : route('press-release.store') }}" 
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($pressRelease)) @method('PUT') @endif

                            <!-- Title -->
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $pressRelease->title ?? '') }}" required>
                                @error('title') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $pressRelease->description ?? '') }}</textarea>
                                @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <!-- Whole Case Study (Rich Text Editor) -->
                            <div class="form-group">
                                <label>Whole Press Release</label>
                                <textarea name="whole_press_release" id="summernote" class="form-control @error('whole_case_study') is-invalid @enderror" required>{{ old('whole_case_study', $pressRelease->whole_case_study ?? '') }}</textarea>
                                @error('whole_case_study') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>

                            <!-- Thumbnail Image -->
                            <div class="form-group">
                                <label>Thumbnail Image</label>
                                <input type="file" name="thumbnail_image" class="form-control @error('thumbnail_image') is-invalid @enderror">
                                @error('thumbnail_image') <span class="invalid-feedback">{{ $message }}</span> @enderror

                                @if(isset($pressRelease) && $pressRelease->thumbnail_image)
                                    <img src="{{ asset('storage/' . $pressRelease->thumbnail_image) }}" width="100" class="mt-2">
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ isset($pressRelease) ? 'Update' : 'Create' }} Press Release
                                </button>
                                <a href="{{ route('press-release.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
