{{-- @extends('frontend.layout.master')
@section('content') --}}
<div class="tab-content-item active mt-4" id="all-jobs">
    <div class="myJob-wrapper">
        @if (!empty($all_jobs))
            @foreach ($all_jobs as $job)
                <div class="myJob-wrapper-single job_open_close_location_{{ $job->id }}">
                    <div class="myJob-wrapper-single-flex flex-between align-items-center">
                        <div class="myJob-wrapper-single-contents">
                            <div class="flex-btn">
                                <span class="myJob-wrapper-single-id">#000{{ $job->id }}</span>
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed">{{ ucfirst($job->type) }}</span>
                                </div>
                                @if ($job->on_off == 0)
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed closed">{{ __('Closed') }}</span>
                                </div>
                                @else
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed active">{{ __('Open') }}</span>
                                </div>
                                @endif
                                @if ($job->current_status == 1)
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed not-started">{{ __('In Progress') }}</span>
                                </div>
                                @endif
                                @if ($job->current_status == 2)
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed completed">{{ __('Complete') }}</span>
                                </div>
                                @endif
                            </div>
                            <h4 class="myJob-wrapper-single-title mt-3">
                                <a href="{{ route('client.job.details', $job->id) }}">{{ $job->title }}</a>
                            </h4>
                            <div class="myJob-wrapper-single-list mt-3">
                                @if ($job->on_off == 1)
                                    <span class="job_publicPrivate_view">{{ __('Public') }}</span>
                                @else
                                    <span class="job_publicPrivate_view">{{ __('Only Me') }}</span>
                                @endif
                                <div class="single-jobs-date mt-0">
                                    {{ Carbon\Carbon::parse($job->created_at)->toFormattedDateString() }}
                                    - <span>{{ __(ucfirst($job->level)) }}</span>
                                </div>
                                <span class="single-jobs-date mt-0">{{ __('Proposals:') }} {{ $job?->job_proposals_count ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-between profile-border-top">
                        <div class="btn-wrapper">
                            <a href="javascript:void(0)" class="job_open_close" data-job-id="{{ $job->id }}"
                                data-job-on-off="{{ $job->on_off }}">
                                @if ($job->on_off == 0)
                                    <span class="btn-profile btn-outline-1">{{ __('Open Job') }}</span>
                                @else
                                    <span class="btn-profile btn-outline-cancel">{{ __('Close Job') }}</span>
                                @endif
                            </a>
                        </div>
                        <div class="btn-wrapper flex-btn gap-2">
                            @if(moduleExists('SecurityManage'))
                                @if(Auth::guard('web')->user()->freeze_job == 'freeze')
                                    <a href="#" class="btn-profile btn-outline-gray disabled-link">
                                        <i class="fa-regular fa-edit"></i>{{ __('Edit Job') }}
                                    </a>
                                @else
                                    <a href="{{ route('client.job.edit', $job->id) }}" class="btn-profile btn-outline-gray">
                                        <i class="fa-regular fa-edit"></i>{{ __('Edit Job') }}
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('client.job.edit', $job->id) }}" class="btn-profile btn-outline-gray">
                                    <i class="fa-regular fa-edit"></i>{{ __('Edit Job') }}
                                </a>
                            @endif
                            <a href="javascript:void(0)" class="btn-profile btn-outline-primary share-job-btn" data-job-id="{{ $job->id }}">
                                <i class="fa-regular fa-share"></i>{{ __('Share Job') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h2 class="text-danger">{{ __('No Jobs Found') }}</h2>
        @endif
    </div>
</div>

<div class="mt-3">
    <x-pagination.laravel-paginate :allData="$all_jobs" />
</div>

<!-- Share Job Modal -->
<div class="modal fade" id="shareJobModal" tabindex="-1" role="dialog" aria-labelledby="shareJobModalLabel" aria-hidden="true" style="background:rgba(88, 88, 88, 0.253);">
    <div class="modal-dialog modal-dialog-centered" role="document"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareJobModalLabel">{{ __('Share Job')}}</h5>
                <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="shareJobLink" class="form-control" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_button" data-dismiss="modal">{{ __('Close') }}</button>
                <a href="#" id="shareFacebook" class="btn btn-primary">{{ __('Facebook') }}</a>
                <a href="#" id="shareTwitter" class="btn btn-info">{{ __('Twitter') }}</a>
                <a href="#" id="shareLinkedIn" class="btn btn-primary">{{ __('LinkedIn') }}</a>
            </div>
        </div>
    </div>
</div>

@section('style')
    <style>
        .modal {
            z-index: 1050;
        }
        .modal-backdrop {
            z-index: 1040;
        }
    </style>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // $('#myModal').modal('show').css('z-index', '9999');
        $(document).ready(function () {
            $('.share-job-btn').on('click', function () {
                let jobId = $(this).data('job-id');
                let jobLink = `{{ url('/job/details') }}/${jobId}`;

                $('#shareJobLink').val(jobLink);
                $('#shareFacebook').attr('href', `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(jobLink)}`);
                $('#shareTwitter').attr('href', `https://twitter.com/intent/tweet?url=${encodeURIComponent(jobLink)}`);
                $('#shareLinkedIn').attr('href', `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(jobLink)}`);

                $('#shareJobModal').modal('show'); // Correct modal activation
            });
            $('.close_button').on('click', function () {
             
                $('#shareJobModal').modal('hide'); // Correct modal activation
            });
        });
    </script>
@endsection
