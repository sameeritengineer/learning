@extends('admin.layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ isset($team) ? 'Edit Team member' : 'Create Team member' }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">{{ isset($team) ? 'Edit Team member' : 'Create Team member' }}</div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ isset($team) ? 'Edit Team member' : 'Create Team member' }}</h4>
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

<form action="{{ isset($team) ? route('team.update', $team->id) : route('team.store') }}" 
      method="POST" enctype="multipart/form-data">
    @csrf
    @if(isset($team))
        @method('PUT') <!-- Use PUT for updates -->
    @endif

    <!-- Name -->
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
               value="{{ old('name', $team->name ?? '') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Position -->
    <div class="form-group">
        <label for="position">Position:</label>
        <input type="text" name="position" id="position" class="form-control @error('position') is-invalid @enderror" 
               value="{{ old('position', $team->position ?? '') }}" required>
        @error('position')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- LinkedIn Link -->
    <div class="form-group">
        <label for="linkedin_link">LinkedIn Profile:</label>
        <input type="url" name="linkedin_link" id="linkedin_link" class="form-control @error('linkedin_link') is-invalid @enderror" 
               value="{{ old('linkedin_link', $team->linkedin_link ?? '') }}">
        @error('linkedin_link')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Description -->
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="summernote" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $team->description ?? '') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Profile Image -->
    <div class="form-group">
        <label for="image">Profile Image:</label>
        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
        @error('image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        @if(isset($team) && $team->image)
            <img src="{{ asset('storage/' . $team->image) }}" width="100" class="mt-2">
        @endif
    </div>

    <!-- Submit Button -->
    <div class="form-group text-right">
        <button type="submit" class="btn btn-success">
            {{ isset($team) ? 'Update' : 'Create' }} Team Member
        </button>
        <a href="{{ route('team.index') }}" class="btn btn-secondary">Cancel</a>
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