@extends('admin.master.master')

@section('content')

@if(count($errors) > 0)
    @foreach($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach
@endif

<div class="row">
    <div class="col-md-6 offset-md-1">
    <a href="{{ url('admin/job/create') }}" class="btn btn-sm btn-primary float-right mb-1">Add</a>
        <table class="table table-striped table-light">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Featured Image</th>
                    <th>Position</th>
                    <th>Expired Date</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $job)
                <tr>
                    <td>{{ $job->job_title }}</td>
                    <td> <img src="{{ asset('/images/') }}/{{ $job->featured_image }}" alt=""> </td>
                    <td>{{ $job->position }}</td>
                    <td>{{ $job->expired_date }}</td>
                    <td>{{ substr($job->description, 0, 10) }}</td>
                    <td>
                        <a href="{{ url('/admin/job/edit/') . '/' . $job->id }}">Edit</a> ||
                        <a href="{{ url('/admin/job/delete/') . '/' . $job->id }}">Delete</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

@endsection
