@extends('admin.master.master')

@section('content')

<div class="container">
    <form action="{{ url('/admin/job/update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $job->id }}">
        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" name="job_title" class="form-control w-50" value="{{ $job->job_title }}">
        </div>
        <div class="form-group">
            <label for="image">Feature Image</label>
            <input type="file" name="featured_image" class="form-control w-50">
            <img width="100" src="{{ asset('/images/') }}/{{ $job->featured_image }}" alt="">
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" name="position" class="form-control w-50" value="{{ $job->position }}">
        </div>
        <div class="form-group">
            <label for="date">Expire Date</label>
            <input type="date" name="expired_date" class="form-control w-50" value="{{ $job->expired_date }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control w-50">{{ $job->description }}</textarea>
        </div>

        <input class="btn btn-primary" type="submit" value="Update">
    </form>
</div>

@endsection
