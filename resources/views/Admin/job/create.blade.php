@extends('admin.master.master')

@section('content')

<div class="container">
    <form action="{{ url('/admin/job/store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" name="job_title" class="form-control w-50">
        </div>
        <div class="form-group">
            <label for="image">Feature Image</label>
            <input type="file" name="featured_image" class="form-control w-50">
        </div>
        <div class="form-group">
            <label for="position">Position</label>
            <input type="text" name="position" class="form-control w-50">
        </div>
        <div class="form-group">
            <label for="date">Expire Date</label>
            <input type="date" name="expired_date" class="form-control w-50">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control w-50"></textarea>
        </div>

        <input class="btn btn-primary" type="submit" value="Save">
    </form>
</div>

@endsection
