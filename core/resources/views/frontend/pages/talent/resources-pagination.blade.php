<!-- filepath: /c:/Users/Admin/Downloads/xilancer-v3.1.0/core/resources/views/frontend/pages/resources/resources-pagination.blade.php -->
@foreach($resources as $resource)
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">{{ $resource->title }}</h5>
                <p class="card-text">{{ $resource->description }}</p>
                <p class="card-text"><strong>{{ __('Role') }}:</strong> {{ $resource->role }}</p>
                <p class="card-text"><strong>{{ __('Experience') }}:</strong> {{ $resource->experience }}</p>
                <p class="card-text"><strong>{{ __('Monthly Rate') }}:</strong> {{ $resource->monthly_salary }}</p>
                <p class="card-text"><strong>{{ __('Hourly Rate') }}:</strong> {{ $resource->hourly_salary }}</p>
                <a href="{{ route('resource.show', $resource->id) }}" class="btn btn-primary">{{ __('View Resource') }}</a>
            </div>
        </div>
    </div>
@endforeach
<div class="col-md-12">
    {{ $resources->links() }}
</div>