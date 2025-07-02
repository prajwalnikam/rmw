<div class="tab-content-item active mt-5" id="proposals">
    <div class="myJob-wrapper">
        <?php if($job_details->job_proposals->count() > 0): ?>
            <?php $__currentLoopData = $job_details->job_proposals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proposal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="myJob-wrapper-single">
                    <?php echo freelancer_skill_match_with_job_skill($proposal->freelancer_id, $job_details->id); ?>

                    <div class="myJob-wrapper-single-flex flex-between align-items-center">
                        <div class="myJob-wrapper-single-contents">
                            <div class="jobFilter-proposal-author-flex">
                                <div class="jobFilter-proposal-author-thumb position-relative">
                                    <?php if($proposal?->freelancer->image): ?>
                                        <a href="<?php echo e(route('freelancer.profile.details', $proposal?->freelancer->username)); ?>">
                                            <img src="<?php echo e(asset('assets/uploads/profile/'.$proposal?->freelancer?->image)); ?>" alt="<?php echo e($proposal?->freelancer?->fullname); ?>">
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('freelancer.profile.details', $proposal?->freelancer->username)); ?>">
                                            <img src="<?php echo e(asset('assets/static/img/author/author.jpg')); ?>" alt="<?php echo e(__('AuthorImg')); ?>">
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="jobFilter-proposal-author-contents">
                                    <h4 class="jobFilter-proposal-author-contents-title">
                                        <a href="<?php echo e(route('freelancer.profile.details', $proposal?->freelancer->username)); ?>">
                                        <?php echo e($proposal->freelancer?->fullname ?? ''); ?>

                                        </a>
                                        <?php if (isset($component)) { $__componentOriginal904e0112ca5a0dc03a39a72400a188a0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal904e0112ca5a0dc03a39a72400a188a0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status.user-active-inactive-check','data' => ['userID' => $proposal->freelancer->id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status.user-active-inactive-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['userID' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal->freelancer->id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal904e0112ca5a0dc03a39a72400a188a0)): ?>
<?php $attributes = $__attributesOriginal904e0112ca5a0dc03a39a72400a188a0; ?>
<?php unset($__attributesOriginal904e0112ca5a0dc03a39a72400a188a0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal904e0112ca5a0dc03a39a72400a188a0)): ?>
<?php $component = $__componentOriginal904e0112ca5a0dc03a39a72400a188a0; ?>
<?php unset($__componentOriginal904e0112ca5a0dc03a39a72400a188a0); ?>
<?php endif; ?>
                                    </h4>
                                    <p class="jobFilter-proposal-author-contents-subtitle mt-2">
                                        <?php echo e($proposal->freelancer?->user_introduction?->title ?? ''); ?> · <span><?php echo e($proposal->freelancer?->user_state?->state ?? ''); ?>, <?php echo e($proposal->freelancer?->user_country?->country ?? ''); ?></span>
                                    </p>
                                    <div class="jobFilter-proposal-author-contents-review mt-2">
                                        <?php echo freelancer_rating($proposal->freelancer_id); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="myJob-wrapper-single-arrow">
                            <div class="job-proposal-btn">
                                <div class="job-proposal-btn-item">
                                    <?php if (isset($component)) { $__componentOriginal78b125a979f4c19ac28d3899b79f9f36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal78b125a979f4c19ac28d3899b79f9f36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.job.job-proposal-view','data' => ['isView' => $proposal->is_view]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('job.job-proposal-view'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['isView' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal->is_view)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal78b125a979f4c19ac28d3899b79f9f36)): ?>
<?php $attributes = $__attributesOriginal78b125a979f4c19ac28d3899b79f9f36; ?>
<?php unset($__attributesOriginal78b125a979f4c19ac28d3899b79f9f36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal78b125a979f4c19ac28d3899b79f9f36)): ?>
<?php $component = $__componentOriginal78b125a979f4c19ac28d3899b79f9f36; ?>
<?php unset($__componentOriginal78b125a979f4c19ac28d3899b79f9f36); ?>
<?php endif; ?>
                                </div>
                                <div class="job-proposal-btn-item">
                                    <?php if (isset($component)) { $__componentOriginal35beda515b977db44ee46e12ed4e7815 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35beda515b977db44ee46e12ed4e7815 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.job.hire-short-list-check','data' => ['isHired' => $proposal->is_hired,'isShortListed' => $proposal->is_short_listed]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('job.hire-short-list-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['isHired' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal->is_hired),'isShortListed' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($proposal->is_short_listed)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35beda515b977db44ee46e12ed4e7815)): ?>
<?php $attributes = $__attributesOriginal35beda515b977db44ee46e12ed4e7815; ?>
<?php unset($__attributesOriginal35beda515b977db44ee46e12ed4e7815); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35beda515b977db44ee46e12ed4e7815)): ?>
<?php $component = $__componentOriginal35beda515b977db44ee46e12ed4e7815; ?>
<?php unset($__componentOriginal35beda515b977db44ee46e12ed4e7815); ?>
<?php endif; ?>
                                </div>
                                <div class="job-proposal-btn-item">
                                    <p class="jobFilter-proposal-author-contents-time"><?php echo e($proposal->created_at->diffForHumans()); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="jobFilter-proposal-offered profile-border-top">
                        <div class="jobFilter-proposal-offered-single">
                            <span class="offered"><?php echo e(__('Offered')); ?>

                                <span class="offered-price"><?php echo e(float_amount_with_currency_symbol($proposal->amount)); ?></span>
                            </span>
                        </div>
                        <div class="jobFilter-proposal-offered-single">
                            <span class="offered"><?php echo e(__('Est. delivery duration')); ?> <span class="offered-days"><?php echo e($proposal->duration); ?></span> </span>
                        </div>
                        <?php if($job_details->type == 'hourly'): ?>
                        <div class="jobFilter-proposal-offered-single">
                            <span class="offered"><?php echo e(__(ucfirst($job_details->type))); ?>

                             <span class="offered-price"><?php echo e(float_amount_with_currency_symbol($job_details->hourly_rate)); ?></span>
                            </span>
                        </div>
                        <?php endif; ?>
                        <?php if($job_details->type == 'hourly'): ?>
                            <div class="jobFilter-proposal-offered-single">
                            <span class="offered"><?php echo e(__('Estimated hour')); ?>

                             <span class="offered-price"><?php echo e($job_details->estimated_hours ?? ''); ?></span>
                            </span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex-between profile-border-top">
                        <div class="btn-wrapper rejected_interview_location_<?php echo e($proposal->id); ?>">
                            <div class="btn-wrapper flex-btn gap-2">
                                <?php if($proposal->is_rejected == 1): ?>
                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray"><?php echo e(__('Rejected')); ?></a>
                                <?php else: ?>
                                    <a href="javascript:void(0)" class="btn-profile btn-outline-gray btn-hover-danger reject_proposal" data-proposal-id="<?php echo e($proposal->id); ?>"><?php echo e(__('Reject')); ?></a>
                                    <a href="javascript:void(0)"
                                       class="btn-profile btn-bg-1 click-interview take_freelancer_interview"
                                       data-job-id="<?php echo e($job_details->id); ?>"
                                       data-proposal-id="<?php echo e($proposal->id); ?>"
                                       data-freelancer-id="<?php echo e($proposal->freelancer_id); ?>"
                                       data-job-title="<?php echo e($job_details->title); ?>"
                                       data-job-level="<?php echo e($job_details->level); ?>"
                                       data-job-type="<?php echo e($job_details->type); ?>"
                                       data-job-create-date="<?php echo e($job_details->created_at); ?>"
                                    >
                                        <?php if($proposal->is_interview_take == 1): ?> <?php echo e(__('Interviewed')); ?> <?php else: ?> <?php echo e(__('Take Interview')); ?> <?php endif; ?>
                                    </a>
                                <?php endif; ?>

                                <?php if($job_details->type == 'hourly'): ?>
                                    <a href="javascript:void(0)"
                                       data-bs-toggle="modal"
                                       data-bs-target="#RateAndHoursModal"
                                       class="btn-profile btn-bg-1"><?php echo e(__('Update Hourly Rate')); ?></a>
                                    <?php endif; ?>
                            </div>
                        </div>
                        <div class="btn-wrapper flex-btn gap-2 add_remove_interview_location_<?php echo e($proposal->id); ?>">
                            <?php if($proposal->is_rejected == 0): ?>
                                <a href="javascript:void(0)" class="btn-profile btn-outline-gray loadingRound add_remove_shortlist" data-proposal-id="<?php echo e($proposal->id); ?>">
                                    <?php if($proposal->is_short_listed == 0): ?>
                                        <span class="add_to_short_listed"><?php echo e(__('Add to Shortlist')); ?></span>
                                    <?php else: ?>
                                        <span class="remove_from_short_listed"><?php echo e(__('Remove from Shortlist')); ?></span>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('client.job.proposal.details',$proposal->id)); ?>" target="_blank" class="btn-profile btn-bg-1"><?php echo e(__('View Proposal')); ?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <h4 class="jobFilter-proposal-author-contents-title text-danger"> <?php echo e(__('Nothing Found')); ?> </h4>
        <?php endif; ?>

    </div>
</div><?php /**PATH /home/piks/Documents/rmwork-zv/core/resources/views/frontend/user/client/job/job-details/proposals.blade.php ENDPATH**/ ?>