@extends('frontend.layout.master')
@section('site_title', __('Match Resources to Jobs'))
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ __('Match Resources to Jobs') }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('client.client.get.matched.resources') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3"> {{-- Added mb-3 for spacing --}}
                            <label for="job_id">{{ __('Select Job') }}</label>
                            <select name="job_id" id="job_id" class="form-control" required>
                                <option value="" disabled @unless(isset($selectedJob)) selected @endunless>{{ __('Select a Job')}} </option>
                                @foreach($jobs as $jobOption) {{-- Renamed $job to $jobOption to prevent confusion with $selectedJob --}}
                                    <option value="{{ $jobOption->id }}" @if(isset($selectedJob) && $selectedJob->id == $jobOption->id) selected @endif>{{ $jobOption->title }}</option>
                                @endforeach
                            </select>
                            {{-- Optional: Display validation error if job_id is required but not selected --}}
                            @error('job_id')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Find Matches') }}</button>
                    </form>

                    @if(isset($resources) && $resources->isNotEmpty())
                        <h5 class="mt-4">{{ __('Matched Resources for Job: ') }}
                            @if(isset($selectedJob))
                                {{ $selectedJob->title }}
                            @else
                                {{ __('(Job Not Selected)') }}
                            @endif
                        </h5>
                        <div class="row mt-3">
                            @foreach($resources as $resource)
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ 'RM-' . $resource->id }}: {{ $resource->title }}</h5>
                                            <p class="card-text"><strong>{{ __('Description:') }}</strong> {{ $resource->description }}</p>
                                            <p class="card-text"><strong>{{ __('Role:') }}</strong> {{ $resource->role }}</p>
                                            <p class="card-text"><strong>{{ __('Specification:') }}</strong> {{ $resource->specification }}</p>
                                            <p class="card-text"><strong>{{ __('Experience (in years):') }}</strong> {{ $resource->experience }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @elseif(isset($resources) && $resources->isEmpty() && isset($selectedJob))
                        <div class="mt-4 alert alert-info" role="alert">
                            {{ __('No matching resources found for job: ') }} "{{ $selectedJob->title }}".
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection