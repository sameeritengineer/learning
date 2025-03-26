@extends('admin.layouts.admin')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Industry Insights</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Industry Insights</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>All Insights</h4>
                <a href="{{ route('industry-insights.create') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Thumbnail</th>
                                <th>PDF Title</th>
                                <th>PDF Link</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($insights as $index => $insight)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if($insight->thumbnail_image)
                                            <img src="{{ asset('storage/' . $insight->thumbnail_image) }}" width="50">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $insight->pdf_title }}</td>
                                    <td>
                                        <a href="{{ asset('storage/' . $insight->pdf_link) }}" download class="btn btn-success btn-sm">Download</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('industry-insights.edit', $insight->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('industry-insights.destroy', $insight->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $insights->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
