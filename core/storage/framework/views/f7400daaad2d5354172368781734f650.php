
<?php $__env->startSection('site_title', __('My Resources')); ?>
<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4><?php echo e(__('My Resources')); ?></h4>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <?php $__currentLoopData = $resources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resource): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4">
                                <div class="card mb-4 h-100">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title"><?php echo e($resource->title); ?></h5>
                                        <p class="card-text description">
                                            <?php if(strlen($resource->description) > 150): ?>
                                                <span class="short-description"><?php echo e(substr($resource->description, 0, 150)); ?>...</span>
                                                <span class="full-description d-none"><?php echo e($resource->description); ?></span>
                                                <a href="#" class="read-more"><?php echo e(__('Read More')); ?></a>
                                            <?php else: ?>
                                                <?php echo e($resource->description); ?>

                                            <?php endif; ?>
                                        </p>
                                        <p class="card-text"><strong><?php echo e(__('Role:')); ?></strong> <?php echo e($resource->role); ?></p>
                                        <p class="card-text"><strong><?php echo e(__('Specification:')); ?></strong> <?php echo e($resource->specification); ?></p>
                                        <p class="card-text"><strong><?php echo e(__('Experience:')); ?></strong> <?php echo e($resource->experience); ?></p>
                                    </div>
                                    <div class="card-footer card-footer-custom">
                                        <form action="<?php echo e(url('freelancer/resource/update-status')); ?>" method="POST" class="mb-2 mt-auto">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?php echo e($resource->id); ?>">
                                            <select name="status" onchange="this.form.submit()" class="form-control">
                                                <option value="1" <?php echo e($resource->status == '1' ? 'selected' : ''); ?>><?php echo e(__('Active')); ?></option>
                                                <option value="0" <?php echo e($resource->status == '0' ? 'selected' : ''); ?>><?php echo e(__('Inactive')); ?></option>
                                            </select>
                                        </form>
                                        <!-- Updated Edit button: no inline onclick -->
                                        <button 
                                            class="btn btn-primary btn-sm mt-auto edit-btn" 
                                            type="button"
                                            data-resource='<?php echo json_encode($resource, 15, 512) ?>'>
                                            <?php echo e(__('Edit')); ?>

                                        </button>
                                        <button class="btn btn-danger btn-sm auto delete-btn" onclick="confirmDelete(<?php echo e($resource->id); ?>)"><?php echo e(__('Delete')); ?></button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center">
                        <?php echo e($resources->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Resource Modal -->
<div class="modal fade" id="editResourceModal" tabindex="-1" role="dialog" aria-labelledby="editResourceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editResourceForm" action="<?php echo e(route('freelancer.resource.update')); ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="editResourceModalLabel"><?php echo e(__('Edit Resource')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo e(__('Close')); ?>">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="editResourceId">
                    <div class="form-group">
                        <label for="editTitle"><?php echo e(__('Resource Name')); ?></label>
                        <input type="text" name="title" id="editTitle" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editDescription"><?php echo e(__('Description')); ?></label>
                        <textarea name="description" id="editDescription" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editRole"><?php echo e(__('Role')); ?></label>
                        <select name="role" id="editRole" class="form-control">
                            <option value=""><?php echo e(__('Select Role')); ?></option>
                            <option value="Developer"><?php echo e(__('Developer')); ?></option>
                            <option value="Tester"><?php echo e(__('Tester')); ?></option>
                            <option value="Other"><?php echo e(__('Other')); ?></option>
                        </select>
                    </div>
                    <div class="form-group" id="editCustomRoleGroup" style="display: none;">
                        <label for="editCustomRole"><?php echo e(__('Custom Role')); ?></label>
                        <input type="text" name="custom_role" id="editCustomRole" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editSpecification"><?php echo e(__('Specification')); ?></label>
                        <input type="text" name="specification" id="editSpecification" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editExperience"><?php echo e(__('Experience')); ?></label>
                        <select name="experience" id="editExperience" class="form-control">
                            <option value=""><?php echo e(__('Select Experience')); ?></option>
                            <option value="1-2"><?php echo e(__('1 to 2 years')); ?></option>
                            <option value="2-4"><?php echo e(__('2 to 4 years')); ?></option>
                            <option value="4-6"><?php echo e(__('4 to 6 years')); ?></option>
                            <option value="6-8"><?php echo e(__('6 to 8 years')); ?></option>
                            <option value="8-10"><?php echo e(__('8 to 10 years')); ?></option>
                            <option value="10+"><?php echo e(__('More than 10 years')); ?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editMonthlySalary"><?php echo e(__('Monthly Rate')); ?></label>
                        <input type="text" name="monthly_salary" id="editMonthlySalary" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editHourlySalary"><?php echo e(__('Hourly Rate')); ?></label>
                        <input type="text" name="hourly_salary" id="editHourlySalary" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel"><?php echo e(__('Delete Resource')); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="<?php echo e(__('Close')); ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo e(__('Are you sure you want to delete this resource?')); ?>

            </div>
            <div class="modal-footer">
                <form id="deleteResourceForm" action="<?php echo e(route('freelancer.resource.delete')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" id="deleteResourceId">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                    <button type="submit" class="btn btn-danger"><?php echo e(__('Delete')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <style>
        .description {
            max-height: 150px;
            overflow: hidden;
            position: relative;
        }
        .description.scrollable {
            max-height: none;
            overflow: auto;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>


    // Edit resource button handler
            document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function () {
                const resource = JSON.parse(this.getAttribute('data-resource'));
                console.log('Editing resource:', resource);

                document.getElementById('editResourceId').value = resource.id || '';
                document.getElementById('editTitle').value = resource.title || '';
                document.getElementById('editDescription').value = resource.description || '';
                document.getElementById('editRole').value = resource.role || '';
                document.getElementById('editSpecification').value = resource.specification || '';
                document.getElementById('editExperience').value = resource.experience || '';
                document.getElementById('editMonthlySalary').value = resource.monthly_salary || '';
                document.getElementById('editHourlySalary').value = resource.hourly_salary || '';

                if (resource.role === 'Other') {
                    document.getElementById('editCustomRoleGroup').style.display = 'block';
                    document.getElementById('editCustomRole').value = resource.custom_role || '';
                } else {
                    document.getElementById('editCustomRoleGroup').style.display = 'none';
                    document.getElementById('editCustomRole').value = '';
                }

                $('#editResourceModal').modal('show');
            });
        });

        // Add this if you want to handle the custom role visibility dynamically after the modal is shown
        document.getElementById('editRole').addEventListener('change', function() {
            const customRoleGroup = document.getElementById('editCustomRoleGroup');
            if (this.value === 'Other') {
                customRoleGroup.style.display = 'block';
            } else {
                customRoleGroup.style.display = 'none';
                document.getElementById('editCustomRole').value = ''; // Clear custom role if not 'Other'
            }
        });

    // Confirm delete
    function confirmDelete(resourceId) {
        document.getElementById('deleteResourceId').value = resourceId;
        $('#deleteConfirmationModal').modal('show');
    }

    // Show/hide custom role input on role change in edit modal
    document.getElementById('editRole').addEventListener('change', function() {
        var role = this.value;
        var customRoleGroup = document.getElementById('editCustomRoleGroup');
        if (role === 'Other') {
            customRoleGroup.style.display = 'block';
        } else {
            customRoleGroup.style.display = 'none';
            document.getElementById('editCustomRole').value = '';
        }
    });

    // Read More / Read Less toggle
    document.addEventListener('DOMContentLoaded', function () {
        const readMoreButtons = document.querySelectorAll('.read-more');
        readMoreButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const cardBody = this.closest('.card-body');
                const shortDescription = cardBody.querySelector('.short-description');
                const fullDescription = cardBody.querySelector('.full-description');
                if (fullDescription.classList.contains('d-none')) {
                    fullDescription.classList.remove('d-none');
                    shortDescription.classList.add('d-none');
                    this.textContent = '<?php echo e(__('Read less')); ?>';
                } else {
                    fullDescription.classList.add('d-none');
                    shortDescription.classList.remove('d-none');
                    this.textContent = '<?php echo e(__('Read More')); ?>';
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/piks/Documents/rmwork-zv/core/resources/views/frontend/user/freelancer/resources/all-resources.blade.php ENDPATH**/ ?>