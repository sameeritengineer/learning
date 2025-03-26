@extends('admin.layouts.admin')

@section('content')
<style>
    td.case_study_description {
        font-size: 13px !important;
    }
</style>

<section class="section">
    <div class="section-header">
        <h1>Case Studies</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Case Studies</div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>All Case Studies</h4>
                    <a href="{{ route('case-studies.create') }}" class="btn btn-primary text-white">Add Case Study</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover m-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($caseStudies as $index => $case)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($case->thumbnail_image)
                                                <img src="{{ asset('storage/' . $case->thumbnail_image) }}" width="50" height="50" alt="Thumbnail" class="img-thumbnail">
                                            @else
                                                <span>No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $case->title }}</td>
                                        <td class="case_study_description">{!! Str::limit($case->description, 50) !!}</td>
                                        <td>
                                            <a href="{{ route('case-studies.edit', $case->id) }}" class="btn btn-warning text-white">Edit</a>
                                            <a href="javascript:void(0);" class="btn btn-danger text-white delete-btn" data-url="{{ route('case-studies.destroy', $case->id) }}">
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3">
                            {!! $caseStudies->links('pagination::bootstrap-4') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.includes.deletepopup')
</section>
@endsection
