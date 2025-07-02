@extends('frontend.layout.master')

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">{{ $resource->title }}</h5>
                    <p class="card-text">{{ $resource->description }}</p>
                    <p class="card-text"><strong>{{ __('Role') }}:</strong> {{ $resource->role }}</p>
                    <p class="card-text"><strong>{{ __('Experience') }}:</strong> {{ $resource->experience }} years</p>
                    <p class="card-text"><strong>{{ __('Monthly Rate') }}:</strong> {{ $resource->monthly_salary }} {{ get_static_option('site_global_currency') ?? '' }}</p>
                    <p class="card-text"><strong>{{ __('Hourly Rate') }}:</strong> {{ $resource->hourly_salary }} {{ get_static_option('site_global_currency') ?? '' }}</p>
                    <p class="card-text"><strong>{{ __('Status') }}:</strong> {{ $resource->status == 1 ? 'Active' : 'Inactive' }}</p>
                    <p class="card-text"><strong>{{ __('Company') }}:</strong> {{ $resource->user ? $resource->user->first_name . ' ' . $resource->user->last_name : 'N/A' }}</p>
                    @if($resource->user)
                         < <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">{{ __('Show Interest') }}</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="contactForm" action="{{ route('resources.contact', $resource->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel">{{ __('Contact') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message" class="form-label">{{ __('Message') }}</label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Send') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.location.hash === '#contact') {
            const contactModal = new bootstrap.Modal(document.getElementById('contactModal'));
            contactModal.show();
        }
    });
</script>
@endsection
