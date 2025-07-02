

<?php $__env->startSection('style'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        <?php $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="card mb-4 card-custom">
                    <div class="card-body card-body-custom">
                        <h5 class="card-title"><?php echo e($resource->title); ?></h5>
                        <p class="card-text truncate"><?php echo e($resource->description); ?></p>
                        <p class="card-text full-description"><?php echo e($resource->description); ?></p>
                        <?php if(strlen($resource->description) > 150): ?>
                            <button class="btn btn-link p-0 read-more-btn"><?php echo e(__('Read More')); ?></button>
                        <?php endif; ?>
                        <p class="card-text"><strong><?php echo e(__('Role')); ?>:</strong> <?php echo e($resource->role); ?></p>
                        <p class="card-text"><strong><?php echo e(__('Experience')); ?>:</strong> <?php echo e($resource->experience); ?> years</p>
                        <p class="card-text"><strong><?php echo e(__('Status')); ?>:</strong><?php echo e($resource->status == 1 ? 'Active' : 'Inactive'); ?></p>
                        <p class="card-text"><strong><?php echo e(__('Company')); ?>:</strong> <?php echo e($resource->user ? $resource->user->first_name .' '. $resource->user->last_name: 'N/A'); ?></p>
                    </div>
                    <div class="card-footer card-footer-custom">
                        <a href="<?php echo e(route('resources.show', $resource->id)); ?>" class="btn btn-primary"><?php echo e(__('View Resource')); ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo e($resources->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
                        this.textContent = '<?php echo e(__('Read Less')); ?>';
                    } else {
                        fullDescription.style.display = 'none';
                        truncateText.style.display = '-webkit-box';
                        this.textContent = '<?php echo e(__('Read More')); ?>';
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/piks/Documents/rmwork-zv/core/resources/views/frontend/pages/talent/resources.blade.php ENDPATH**/ ?>