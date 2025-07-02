@if($all_proposals->total() < 1)
    <div class="myOrder-single bg-white padding-20 radius-10">
        <div class="myOrder-single-item">
            <h4 class="text-danger">{{ __('No Proposals Found') }}</h4>
        </div>
    </div>
@else
    @foreach($all_proposals as $proposal)
        <div class="myOrder-single bg-white padding-20 radius-10">
            <div class="myOrder-single-item">
                <div class="myOrder-single-flex">
                    <div class="myOrder-single-content">
                        <span class="myOrder-single-content-id">#000{{ $proposal->id }}</span>
                        <div class="myOrder-single-content-btn flex-btn mt-3">
                            <x-job.job-proposal-view :isView="$proposal->is_view" />
                            <div class="job-proposal-btn-item">
                                <x-job.hire-short-list-check :isHired="$proposal->is_hired" :isShortListed="$proposal->is_short_listed" />
                            </div>
                            @if ($proposal->is_interview_take == 1)
                                <span class="shortlisted-item seen">{{ __('Interviewed') }}</span>
                            @endif
                        </div>
                    </div>
                    <span class="myOrder-single-content-time">{{ $proposal->created_at->diffForHumans() }} </span>
                </div>
            </div>
            <div class="myOrder-single-item">
                <div class="myOrder-single-block">
                    <div class="myOrder-single-block-item">
                        <div class="myOrder-single-block-item-content">
                            <span class="myOrder-single-block-subtitle">{{ __('Offer Price') }}</span>
                            <h6 class="myOrder-single-block-title mt-2">{{ float_amount_with_currency_symbol($proposal->amount) }}
                            </h6>
                        </div>
                    </div>
                    @if($proposal->duration)
                        <div class="myOrder-single-block-item">
                            <div class="myOrder-single-block-item-content">
                                <span class="myOrder-single-block-subtitle">{{ __('Delivery Time') }}</span> <br>
                                <h6 class="myOrder_single__block__title mt-2">
                                    {{ $proposal->duration }}
                                </h6>
                            </div>
                        </div>
                    @endif
                    <div class="myOrder-single-block-item">
                        <div class="myOrder-single-block-item-content">
                            <span class="myOrder-single-block-subtitle">{{ __('Create Date') }}</span><br>
                            <h6 class="myOrder_single__block__title mt-2">
                                {{ $proposal->created_at->toFormattedDateString() ?? '' }}
                            </h6>
                        </div>
                    </div>

                    @if($proposal->attachment)
                        <div class="myJob-wrapper-single">
                            <div class="myJob-wrapper-single-contents">
                                @if(cloudStorageExist() && in_array(Storage::getDefaultDriver(), ['s3', 'cloudFlareR2', 'wasabi']))
                                    <a href="{{ render_frontend_cloud_image_if_module_exists('jobs/proposal/'.$proposal->attachment, load_from: $proposal->load_from) }}"
                                       download
                                       class="single-refundRequest-item-uploads">
                                        <i class="fa-solid fa-cloud-arrow-down"></i>
                                        {{ __('Download Attachment') }}
                                    </a>
                                @else
                                <a href="{{ asset('assets/uploads/jobs/proposal/'.$proposal->attachment) }}" download class="single-refundRequest-item-uploads">
                                    <i class="fa-solid fa-cloud-arrow-down"></i>
                                    {{  __('Download Attachment') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>

                {{-- NEW SECTION: Display Attached Resources --}}
                {{-- Check if loaded_attached_resources exists and is not empty --}}
                @if(isset($proposal->loaded_attached_resources) && $proposal->loaded_attached_resources->isNotEmpty())
                    <h6 class="mt-4 mb-2">{{ __('Attached Resources:') }}</h6>
                    <div class="row">
                        @foreach($proposal->loaded_attached_resources as $attachedResource)
                            <div class="col-md-6 mb-3"> {{-- Adjust column size (e.g., col-md-4, col-md-6) as needed for layout --}}
                                <div class="card card-small border">
                                    <div class="card-body p-3">
                                        <h5 class="card-title mb-1">{{ $attachedResource->title }}</h5>
                                        <p class="card-text text-muted mb-2">{{ Str::limit($attachedResource->description, 50) }}</p>
                                        <ul class="list-unstyled mb-0 small">
                                            @if($attachedResource->role)
                                                <li><strong>Role:</strong> {{ $attachedResource->role }}</li>
                                            @endif
                                            @if($attachedResource->experience)
                                                <li><strong>Experience:</strong> {{ $attachedResource->experience }} years</li>
                                            @endif
                                            @if($attachedResource->monthly_salary)
                                                <li><strong>Monthly Salary:</strong> {{ get_static_option('site_global_currency') }}  {{ number_format($attachedResource->monthly_salary, 2) }}</li>
                                            @endif
                                            @if($attachedResource->hourly_salary)
                                                <li><strong>Hourly Salary:</strong>{{ get_static_option('site_global_currency') }}  {{ number_format($attachedResource->hourly_salary, 2) }} / hour</li>
                                            @endif
                                            @if($attachedResource->status)
                                                <li><strong>Status:</strong> <span class="badge {{ $attachedResource->status == 'available' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($attachedResource->status) }}</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-4 text-muted">{{ __('No specific resources attached to this proposal.') }}</p>
                @endif

                <p class="mt-4">{{ Str::limit($proposal->cover_letter,250 ?? '')  }}</p>
            </div>
            <div class="myOrder-single-item">
                <div class="myOrder-single-flex flex-between">

                    @if(moduleExists('HourlyJob'))
                        @if($proposal?->job->type == 'hourly')
                            <div class="jobFilter-proposal-offered-single">
                                <span class="offered">{{ __(ucfirst($proposal?->job->type)) }}
                                 <span class="offered-price">{{ float_amount_with_currency_symbol($proposal?->job->hourly_rate) }}</span>
                                </span>
                            </div>
                        @endif
                        @if($proposal?->job->type == 'hourly')
                            <div class="jobFilter-proposal-offered-single">
                                <span class="offered">{{ __('Estimated Hour') }}
                                 <span class="offered-price">{{ $proposal?->job->estimated_hours ?? '' }}</span>
                                </span>
                            </div>
                        @endif
                    @endif

                    <div class="btn-wrapper flex-btn">
                        <button
                           class="btn-profile btn-outline-1 cover_letter_details"
                           data-bs-target="#CoverLetterModal"
                           data-bs-toggle="modal"
                           data-cover-letter="{{$proposal->cover_letter}}"
                        >
                            {{ __('Proposal Details') }}
                        </button>
                    </div>
                    <div class="btn-wrapper flex-btn">
                        <a href="{{ route('job.details', ['username' => $proposal?->job?->job_creator?->username, 'slug' => $proposal?->job?->slug]) }}"
                           class="btn-profile btn-bg-1"
                           target="_blank">
                            {{ __('Job Details') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <x-pagination.laravel-paginate :allData="$all_proposals" />
@endif