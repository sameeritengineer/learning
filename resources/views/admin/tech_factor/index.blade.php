@extends('admin.layouts.admin')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Tech Factor Episodes</h1>
        <div class="ml-auto">
            <a href="{{ route('tech-factor.create') }}" class="btn btn-primary">
                + Add New Episode
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Season</th>
                        <th>Episode Title</th>
                        <th>Episode Number</th>
                        <th>Thumbnail</th>
                        <th>Video Link</th>
                        <th>Spotify</th>
                        <th>Radio</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($episodes as $index => $episode)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \App\Models\TechFactor::seasons()[$episode->season] ?? $episode->season }}</td>
                            <td>{{ $episode->episode_title }}</td>
                            <td>{{ $episode->episode_number }}</td>
                            <td>
                                @if($episode->thumbnail_image)
                                    <img src="{{ asset('storage/' . $episode->thumbnail_image) }}" width="60">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ $episode->video_link }}" target="_blank" class="btn btn-sm btn-info">
                                    Watch Video
                                </a>
                            </td>
                            <td>
                                @if($episode->spotify_link)
                                    <a href="{{ $episode->spotify_link }}" target="_blank" class="btn btn-sm btn-success">
                                        Spotify
                                    </a>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                @if($episode->radio_link)
                                    <a href="{{ $episode->radio_link }}" target="_blank" class="btn btn-sm btn-warning">
                                        Radio
                                    </a>
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tech-factor.edit', $episode->id) }}" class="btn btn-sm btn-primary">
                                    Edit
                                </a>

                                <form action="{{ route('tech-factor.destroy', $episode->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Are you sure you want to delete this episode?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted">No episodes found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                                {!! $episodes->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</section>
@endsection
