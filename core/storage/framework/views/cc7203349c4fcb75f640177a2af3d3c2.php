

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($resource->title); ?></h5>
                    <p class="card-text"><?php echo e($resource->description); ?></p>
                    <p class="card-text"><strong><?php echo e(__('Role')); ?>:</strong> <?php echo e($resource->role); ?></p>
                    <p class="card-text"><strong><?php echo e(__('Experience')); ?>:</strong> <?php echo e($resource->experience); ?> years</p>
                    <p class="card-text"><strong><?php echo e(__('Monthly Rate')); ?>:</strong> <?php echo e($resource->monthly_salary); ?> <?php echo e(get_static_option('site_global_currency') ?? ''); ?></p>
                    <p class="card-text"><strong><?php echo e(__('Hourly Rate')); ?>:</strong> <?php echo e($resource->hourly_salary); ?> <?php echo e(get_static_option('site_global_currency') ?? ''); ?></p>
                    <p class="card-text"><strong><?php echo e(__('Status')); ?>:</strong> <?php echo e($resource->status == 1 ? 'Active' : 'Inactive'); ?></p>
                    <p class="card-text"><strong><?php echo e(__('Company')); ?>:</strong> <?php echo e($resource->user ? $resource->user->first_name . ' ' . $resource->user->last_name : 'N/A'); ?></p>
                    <?php if($resource->user): ?>
                         < <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal"><?php echo e(__('Show Interest')); ?></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="contactForm" action="<?php echo e(route('resources.contact', $resource->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="contactModalLabel"><?php echo e(__('Contact')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="message" class="form-label"><?php echo e(__('Message')); ?></label>
                        <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Send')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.location.hash === '#contact') {
            const contactModal = new bootstrap.Modal(document.getElementById('contactModal'));
            contactModal.show();
        }
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/piks/Documents/rmwork-zv/core/resources/views/frontend/pages/talent/resource-view.blade.php ENDPATH**/ ?>