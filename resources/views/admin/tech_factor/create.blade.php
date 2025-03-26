@extends('admin.layouts.admin')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{ isset($episode) ? 'Edit Episode' : 'Add New Episode' }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-10 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form action="{{ isset($episode) ? route('tech-factor.update', $episode->id) : route('tech-factor.store') }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @if(isset($episode))
                            @method('PUT')
                        @endif

                        <!-- Season Selection -->
                        <div class="form-group">
                            <label for="season">Season:</label>
                            <select name="season" class="form-control @error('season') is-invalid @enderror" required>
                                <option value="">Select Season</option>
                                @foreach($seasons as $key => $seasonTitle)
                                    <option value="{{ $key }}" {{ old('season', $episode->season ?? '') == $key ? 'selected' : '' }}>
                                        {{ $seasonTitle }}
                                    </option>
                                @endforeach
                            </select>
                            @error('season')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Episode Title -->
                        <div class="form-group">
                            <label for="episode_title">Episode Title:</label>
                            <input type="text" name="episode_title" id="episode_title" class="form-control @error('episode_title') is-invalid @enderror"
                                   value="{{ old('episode_title', $episode->episode_title ?? '') }}" required>
                            @error('episode_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Episode Number -->
                        <div class="form-group">
                            <label for="episode_number">Episode Number:</label>
                            <input type="number" name="episode_number" id="episode_number" class="form-control @error('episode_number') is-invalid @enderror"
                                   value="{{ old('episode_number', $episode->episode_number ?? '') }}" required>
                            @error('episode_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Video Link -->
                        <div class="form-group">
                            <label for="video_link">Video Link:</label>
                            <input type="url" name="video_link" id="video_link" class="form-control @error('video_link') is-invalid @enderror"
                                   value="{{ old('video_link', $episode->video_link ?? '') }}" required>
                            @error('video_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Spotify & Radio Links -->
                        <div class="form-group">
                            <label for="spotify_link">Spotify Link:</label>
                            <input type="url" name="spotify_link" id="spotify_link" class="form-control" value="{{ old('spotify_link', $episode->spotify_link ?? '') }}">
                        </div>

                        <div class="form-group">
                            <label for="radio_link">Radio Link:</label>
                            <input type="url" name="radio_link" id="radio_link" class="form-control" value="{{ old('radio_link', $episode->radio_link ?? '') }}">
                        </div>

                        <!-- Thumbnail Image -->
                        <div class="form-group">
                            <label for="thumbnail_image">Thumbnail Image:</label>
                            <input type="file" name="thumbnail_image" id="thumbnail_image" class="form-control">
                            @if(isset($episode) && $episode->thumbnail_image)
                                <img src="{{ asset('storage/' . $episode->thumbnail_image) }}" width="100" class="mt-2">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ isset($episode) ? 'Update' : 'Create' }} Episode
                        </button>
                        <a href="{{ route('tech-factor.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
