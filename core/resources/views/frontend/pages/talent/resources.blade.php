@extends('frontend.layout.master')

@section('style')
    <style>
        .card-custom {
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .card-body-custom {
            flex: 1;
            overflow: hidden;
        }
        .card-footer-custom {
            margin-top: auto;
        }
        .truncate {
            display: -webkit-box;
            -webkit-line-clamp: 3; /* number of lines to show */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .full-description {
            display: none;
            max-height: 150px;
            overflow-y: auto;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        @foreach($resources as $resource)
            <div class="col-md-4">
                <div class="card mb-4 card-custom">
                    <div class="card-body card-body-custom">
                        <h5 class="card-title">{{ $resource->title }}</h5>
                        <p class="card-text truncate">{{ $resource->description }}</p>
                        <p class="card-text full-description">{{ $resource->description }}</p>
                        @if(strlen($resource->description) > 150)
                            <button class="btn btn-link p-0 read-more-btn">{{ __('Read More') }}</button>
                        @endif
                        <p class="card-text"><strong>{{ __('Role') }}:</strong> {{ $resource->role }}</p>
                        <p class="card-text"><strong>{{ __('Experience') }}:</strong> {{ $resource->experience }} years</p>
                        <p class="card-text"><strong>{{__('Status')}}:</strong>{{$resource->status == 1 ? 'Active' : 'Inactive'}}</p>
                        <p class="card-text"><strong>{{ __('Company') }}:</strong> {{ $resource->user ? $resource->user->first_name .' '. $resource->user->last_name: 'N/A' }}</p>
                    </div>
                    <div class="card-footer card-footer-custom">
                        <a href="{{ route('resources.show', $resource->id) }}" class="btn btn-primary">{{ __('View Resource') }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            {{ $resources->links() }}
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const readMoreButtons = document.querySelectorAll('.read-more-btn');
            readMoreButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const cardBody = this.closest('.card-body-custom');
                    const truncateText = cardBody.querySelector('.truncate');
                    const fullDescription = cardBody.querySelector('.full-description');
                    if (fullDescription.style.display === 'none') {
                        fullDescription.style.display = 'block';
                        truncateText.style.display = 'none';
                        this.textContent = '{{ __('Read Less') }}';
                    } else {
                        fullDescription.style.display = 'none';
                        truncateText.style.display = '-webkit-box';
                        this.textContent = '{{ __('Read More') }}';
                    }
                });
            });
        });
    </script>
@endsection