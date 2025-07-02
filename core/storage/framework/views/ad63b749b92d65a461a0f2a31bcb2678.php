
<?php $__env->startSection('site_title', __('Match Resources to Jobs')); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('Match Resources to Jobs')); ?></h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('client.client.get.matched.resources')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="form-group mb-3"> 
                            <label for="job_id"><?php echo e(__('Select Job')); ?></label>
                            <select name="job_id" id="job_id" class="form-control" required>
                                <option value="" disabled <?php if (! (isset($selectedJob))): ?> selected <?php endif; ?>><?php echo e(__('Select a Job')); ?> </option>
                                <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jobOption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                    <option value="<?php echo e($jobOption->id); ?>" <?php if(isset($selectedJob) && $selectedJob->id == $jobOption->id): ?> selected <?php endif; ?>><?php echo e($jobOption->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            
                            <?php $__errorArgs = ['job_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger mt-1"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('Find Matches')); ?></button>
                    </form>

                    <?php if(isset($resources) && $resources->isNotEmpty()): ?>
                        <h5 class="mt-4"><?php echo e(__('Matched Resources for Job: ')); ?>

                            <?php if(isset($selectedJob)): ?>
                                <?php echo e($selectedJob->title); ?>

                            <?php else: ?>
                                <?php echo e(__('(Job Not Selected)')); ?>

                            <?php endif; ?>
                        </h5>
                        <div class="row mt-3">
                            <?php $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo e('RM-' . $resource->id); ?>: <?php echo e($resource->title); ?></h5>
                                            <p class="card-text"><strong><?php echo e(__('Description:')); ?></strong> <?php echo e($resource->description); ?></p>
                                            <p class="card-text"><strong><?php echo e(__('Role:')); ?></strong> <?php echo e($resource->role); ?></p>
                                            <p class="card-text"><strong><?php echo e(__('Specification:')); ?></strong> <?php echo e($resource->specification); ?></p>
                                            <p class="card-text"><strong><?php echo e(__('Experience (in years):')); ?></strong> <?php echo e($resource->experience); ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php elseif(isset($resources) && $resources->isEmpty() && isset($selectedJob)): ?>
                        <div class="mt-4 alert alert-info" role="alert">
                            <?php echo e(__('No matching resources found for job: ')); ?> "<?php echo e($selectedJob->title); ?>".
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/piks/Documents/rmwork-zv/core/resources/views/frontend/user/freelancer/resources/match-resources.blade.php ENDPATH**/ ?>