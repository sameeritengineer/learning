@extends('admin.layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($industryInsight) ? 'Edit Industry Insight' : 'Create Industry Insight' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('industry-insights.index') }}">Industry Insights</a></div>
                <div class="breadcrumb-item">{{ isset($industryInsight) ? 'Edit' : 'Create' }}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($industryInsight) ? 'Edit Industry Insight' : 'Create Industry Insight' }}</h4>
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

                        <form action="{{ isset($industryInsight) ? route('industry-insights.update', $industryInsight->id) : route('industry-insights.store') }}" 
                              method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($industryInsight)) @method('PUT') @endif

                            <!-- PDF Title -->
                            <div class="form-group">
                                <label for="pdf_title">PDF Title:</label>
                                <input type="text" name="pdf_title" id="pdf_title" class="form-control @error('pdf_title') is-invalid @enderror" 
                                       value="{{ old('pdf_title', $industryInsight->pdf_title ?? '') }}" required>
                                @error('pdf_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Thumbnail Image -->
                            <div class="form-group">
                                <label for="thumbnail_image">Thumbnail Image:</label>
                                <input type="file" name="thumbnail_image" id="thumbnail_image" class="form-control @error('thumbnail_image') is-invalid @enderror">
                                @error('thumbnail_image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(isset($industryInsight) && $industryInsight->thumbnail_image)
                                    <img src="{{ asset('storage/' . $industryInsight->thumbnail_image) }}" width="100" class="mt-2">
                                @endif
                            </div>

                            <!-- PDF Upload -->
                            <div class="form-group">
                                <label for="pdf_link">Upload PDF:</label>
                                <input type="file" name="pdf_link" id="pdf_link" class="form-control @error('pdf_link') is-invalid @enderror">
                                @error('pdf_link')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if(isset($industryInsight) && $industryInsight->pdf_link)
                                    <div class="mt-2">
                                        <a href="{{ asset('storage/' . $industryInsight->pdf_link) }}" class="btn btn-success btn-sm" download>Download Current PDF</a>
                                    </div>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-success">
                                    {{ isset($industryInsight) ? 'Update' : 'Create' }} Industry Insight
                                </button>
                                <a href="{{ route('industry-insights.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
