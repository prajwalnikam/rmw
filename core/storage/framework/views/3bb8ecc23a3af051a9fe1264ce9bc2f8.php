
<div class="tab-content-item active mt-4" id="all-jobs">
    <div class="myJob-wrapper">
        <?php if(!empty($all_jobs)): ?>
            <?php $__currentLoopData = $all_jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="myJob-wrapper-single job_open_close_location_<?php echo e($job->id); ?>">
                    <div class="myJob-wrapper-single-flex flex-between align-items-center">
                        <div class="myJob-wrapper-single-contents">
                            <div class="flex-btn">
                                <span class="myJob-wrapper-single-id">#000<?php echo e($job->id); ?></span>
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed"><?php echo e(ucfirst($job->type)); ?></span>
                                </div>
                                <?php if($job->on_off == 0): ?>
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed closed"><?php echo e(__('Closed')); ?></span>
                                </div>
                                <?php else: ?>
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed active"><?php echo e(__('Open')); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($job->current_status == 1): ?>
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed not-started"><?php echo e(__('In Progress')); ?></span>
                                </div>
                                <?php endif; ?>
                                <?php if($job->current_status == 2): ?>
                                <div class="btn-item">
                                    <span class="myJob-wrapper-single-fixed completed"><?php echo e(__('Complete')); ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                            <h4 class="myJob-wrapper-single-title mt-3">
                                <a href="<?php echo e(route('client.job.details', $job->id)); ?>"><?php echo e($job->title); ?></a>
                            </h4>
                            <div class="myJob-wrapper-single-list mt-3">
                                <?php if($job->on_off == 1): ?>
                                    <span class="job_publicPrivate_view"><?php echo e(__('Public')); ?></span>
                                <?php else: ?>
                                    <span class="job_publicPrivate_view"><?php echo e(__('Only Me')); ?></span>
                                <?php endif; ?>
                                <div class="single-jobs-date mt-0">
                                    <?php echo e(Carbon\Carbon::parse($job->created_at)->toFormattedDateString()); ?>

                                    - <span><?php echo e(__(ucfirst($job->level))); ?></span>
                                </div>
                                <span class="single-jobs-date mt-0"><?php echo e(__('Proposals:')); ?> <?php echo e($job?->job_proposals_count ?? 0); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="flex-between profile-border-top">
                        <div class="btn-wrapper">
                            <a href="javascript:void(0)" class="job_open_close" data-job-id="<?php echo e($job->id); ?>"
                                data-job-on-off="<?php echo e($job->on_off); ?>">
                                <?php if($job->on_off == 0): ?>
                                    <span class="btn-profile btn-outline-1"><?php echo e(__('Open Job')); ?></span>
                                <?php else: ?>
                                    <span class="btn-profile btn-outline-cancel"><?php echo e(__('Close Job')); ?></span>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="btn-wrapper flex-btn gap-2">
                            <?php if(moduleExists('SecurityManage')): ?>
                                <?php if(Auth::guard('web')->user()->freeze_job == 'freeze'): ?>
                                    <a href="#" class="btn-profile btn-outline-gray disabled-link">
                                        <i class="fa-regular fa-edit"></i><?php echo e(__('Edit Job')); ?>

                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('client.job.edit', $job->id)); ?>" class="btn-profile btn-outline-gray">
                                        <i class="fa-regular fa-edit"></i><?php echo e(__('Edit Job')); ?>

                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="<?php echo e(route('client.job.edit', $job->id)); ?>" class="btn-profile btn-outline-gray">
                                    <i class="fa-regular fa-edit"></i><?php echo e(__('Edit Job')); ?>

                                </a>
                            <?php endif; ?>
                            <a href="javascript:void(0)" class="btn-profile btn-outline-primary share-job-btn" data-job-id="<?php echo e($job->id); ?>">
                                <i class="fa-regular fa-share"></i><?php echo e(__('Share Job')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <h2 class="text-danger"><?php echo e(__('No Jobs Found')); ?></h2>
        <?php endif; ?>
    </div>
</div>

<div class="mt-3">
    <?php if (isset($component)) { $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.pagination.laravel-paginate','data' => ['allData' => $all_jobs]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination.laravel-paginate'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['allData' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($all_jobs)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $attributes = $__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__attributesOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f)): ?>
<?php $component = $__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f; ?>
<?php unset($__componentOriginal0143df8887fb9686c5dbf1f1b0d7027f); ?>
<?php endif; ?>
</div>

<!-- Share Job Modal -->
<div class="modal fade" id="shareJobModal" tabindex="-1" role="dialog" aria-labelledby="shareJobModalLabel" aria-hidden="true" style="background:rgba(88, 88, 88, 0.253);">
    <div class="modal-dialog modal-dialog-centered" role="document"> 
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shareJobModalLabel"><?php echo e(__('Share Job')); ?></h5>
                <button type="button" class="close close_button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" id="shareJobLink" class="form-control" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close_button" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                <a href="#" id="shareFacebook" class="btn btn-primary"><?php echo e(__('Facebook')); ?></a>
                <a href="#" id="shareTwitter" class="btn btn-info"><?php echo e(__('Twitter')); ?></a>
                <a href="#" id="shareLinkedIn" class="btn btn-primary"><?php echo e(__('LinkedIn')); ?></a>
            </div>
        </div>
    </div>
</div>

<?php $__env->startSection('style'); ?>
    <style>
        .modal {
            z-index: 1050;
        }
        .modal-backdrop {
            z-index: 1040;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // $('#myModal').modal('show').css('z-index', '9999');
        $(document).ready(function () {
            $('.share-job-btn').on('click', function () {
                let jobId = $(this).data('job-id');
                let jobLink = `<?php echo e(url('/job/details')); ?>/${jobId}`;

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
<?php $__env->stopSection(); ?>
<?php /**PATH /home/piks/Documents/rmwork-zv/core/resources/views/frontend/user/client/job/my-job/search-result.blade.php ENDPATH**/ ?>