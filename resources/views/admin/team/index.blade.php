@extends('admin.layouts.admin')

@section('content')
<style>
	td.team_member_position h5 {
    font-size: 13px !important;
}
</style>
    <section class="section">
        <div class="section-header">
            <h1>Our Team</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Our Team</div>
            </div>
        </div>
    
        <div class="row">
            <div class="col-lg-12 col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Team Members</h4>
                        <a href="{{ route('team.create') }}" class="btn btn-primary text-white">Add Team Member</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover m-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Profile Image</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>LinkedIn</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teams as $index => $member)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if($member->image)
                                                    <img src="{{ asset('storage/' . $member->image) }}" width="50" height="50" alt="Profile Image" class="img-thumbnail">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $member->name }}</td>
                                            <td class="team_member_position">{!! $member->position !!}</td>
                                            <td>
                                                @if($member->linkedin_link)
                                                    <a href="{{ $member->linkedin_link }}" target="_blank" class="btn btn-info btn-sm">LinkedIn</a>
                                                @else
                                                    <span>N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('team.edit', $member->id) }}" class="btn btn-warning text-white">Edit</a>
                                                <a href="javascript:void(0);" class="btn btn-danger text-white delete-btn" data-url="{{ route('team.destroy', $member->id) }}">
                                                Delete
                                            </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center mt-3">
                                {!! $teams->links('pagination::bootstrap-4') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.includes.deletepopup')
    </section>
@endsection
