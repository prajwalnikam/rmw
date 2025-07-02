@extends('frontend.layout.master')

@section('site_title', __('Post Project Requirement'))

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Post Your Project Requirement') }}</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('client.projects.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">{{ __('Project Title') }}</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter project title" required>
                            </div>

                            <div class="form-group">
                                <label for="description">{{ __('Project Description') }}</label>
                                <textarea name="description" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Job Requirements') }}</label>
                                <div id="job-requirements">
                                    <div class="job-entry">
                                        <input type="text" name="job_titles[]" class="form-control mb-2" placeholder="Job Title" required>
                                        <textarea name="job_descriptions[]" class="form-control mb-2" placeholder="Job Description"></textarea>
                                        <input type="number" name="vacancies[]" class="form-control mb-2" placeholder="Vacancies" required>
                                        <input type="number" name="salaries[]" class="form-control mb-2" placeholder="Salary">
                                        <button type="button" class="btn btn-danger remove-job">Remove</button>
                                    </div>
                                </div>
                                <button type="button" id="add-job" class="btn btn-success">Add Job Requirement</button>
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Post Requirement</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script>
    document.getElementById('add-job').addEventListener('click', function() {
        let newJobEntry = document.querySelector('.job-entry').cloneNode(true);
        newJobEntry.querySelectorAll('input, textarea').forEach(field => field.value = '');
        document.getElementById('job-requirements').appendChild(newJobEntry);
    });

    document.getElementById('job-requirements').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-job')) {
            e.target.closest('.job-entry').remove();
        }
    });
</script>
@endsection
