{{-- filepath: resources/views/frontend/client/job-requirements/create.blade.php --}}
@extends('frontend.layout.master')

@section('content')
<div class="container">
    <h1>Add Job Requirement to Project: {{ $project->title }}</h1>
    <form action="{{ route('client.job-requirements.store', $project) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Job Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="budget">Budget</label>
            <input type="number" name="budget" id="budget" class="form-control">
        </div>
        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="date" name="deadline" id="deadline" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Job Requirement</button>
    </form>
</div>
@endsection