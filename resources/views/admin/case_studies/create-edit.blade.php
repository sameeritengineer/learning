@extends('admin.layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($caseStudy) ? 'Edit Case Study' : 'Create Case Study' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">{{ isset($caseStudy) ? 'Edit Case Study' : 'Create Case Study' }}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($caseStudy) ? 'Edit Case Study' : 'Create Case Study' }}</h4>
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

                        <form action="{{ isset($caseStudy) ? route('case-studies.update', $caseStudy->id) : route('case-studies.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($caseStudy)) @method('PUT') @endif

                            <!-- Title -->
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       value="{{ old('title', $caseStudy->title ?? '') }}" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $caseStudy->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Whole Case Study -->
                            <div class="form-group">
                                <label>Whole Case Study</label>
                                <textarea name="whole_case_study" id="summernote2" class="form-control @error('whole_case_study') is-invalid @enderror" required>{{ old('whole_case_study', $caseStudy->whole_case_study ?? '') }}</textarea>
                                @error('whole_case_study')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Thumbnail Image -->
                            <div class="form-group">
                                <label>Thumbnail Image</label>
                                <input type="file" name="thumbnail_image" class="form-control @error('thumbnail_image') is-invalid @enderror">
                                @error('thumbnail_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(isset($caseStudy) && $caseStudy->thumbnail_image)
                                    <img src="{{ asset('storage/' . $caseStudy->thumbnail_image) }}" width="100" class="mt-2">
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ isset($caseStudy) ? 'Update' : 'Create' }} Case Study
                                </button>
                                <a href="{{ route('case-studies.index') }}" class="btn btn-secondary">Cancel</a>
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
            $('#summernote, #summernote2').summernote({
                height: 300,
                minHeight: 200,
                maxHeight: 500,
                focus: false,
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
