<!-- Budget, Skills Start -->
<div class="setup-wrapper-contents">
    <div class="setup-wrapper-contents-item">
        <div class="setup-bank-form">
            <div class="setup-bank-form-item">
                <label class="label-title"><?php echo e(__('Job type')); ?></label>
                <select class="form-control" name="type" id="type">
                    <option value="fixed" selected><?php echo e(__('Fixed-Price (Pay a fixed amount for the job)')); ?></option>
                    <option value="hourly"><?php echo e(__('Hourly Rate (Pay based on total hours worked for the job)')); ?></option>
                </select>
            </div>

            <div class="setup-bank-form-item setup-bank-form-item-icon d-none manage-hourly-jobs">
                <label class="label-title"><?php echo e(__('Hourly Rate')); ?></label>
                <input type="number" class="form--control" name="hourly_rate"
                    onkeyup="setTimeout(() => { if (this.value === '' || this.value <= 0) this.value = 1; if (this.value > 100000) this.value = 100000; }, 1500);"
                    id="hourly_rate" placeholder="<?php echo e(__('Enter Hourly Rate')); ?>">
                
                <span class="input-icon"><?php echo e(get_static_option('site_global_currency') ?? ''); ?></span>
            </div>
            <div class="setup-bank-form-item d-none manage-hourly-jobs">
                <label class="label-title"><?php echo e(__('Estimated Hours')); ?></label>
                <input type="number" class="form--control" name="estimated_hours"
                    onkeyup="setTimeout(() => { if (this.value === '' || this.value <= 0) this.value = 1; if (this.value > 100000) this.value = 100000; }, 1500);"
                    id="estimated_hours" placeholder="<?php echo e(__('Enter Estimated Hours')); ?>">
            </div>
            <div class="setup-bank-form-item setup-bank-form-item-icon manage-fixed-jobs">
                <label class="label-title"><?php echo e(__('Enter Budget')); ?></label>
                <input type="number" class="form--control" name="budget" id="budget" value="0"
                    placeholder="<?php echo e(__('Enter Your Budget')); ?>">
                <span class="input-icon"><?php echo e(get_static_option('site_global_currency') ?? ''); ?></span>
            </div>
            <?php if (isset($component)) { $__componentOriginala124c3bc37ece30a28542c79ab0e16f1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala124c3bc37ece30a28542c79ab0e16f1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.skill-dropdown','data' => ['title' => __('Select Skill'),'name' => 'skill[]','id' => 'skill','class' => 'form-control skill_select2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('form.skill-dropdown'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Select Skill')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('skill[]'),'id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('skill'),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('form-control skill_select2')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala124c3bc37ece30a28542c79ab0e16f1)): ?>
<?php $attributes = $__attributesOriginala124c3bc37ece30a28542c79ab0e16f1; ?>
<?php unset($__attributesOriginala124c3bc37ece30a28542c79ab0e16f1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala124c3bc37ece30a28542c79ab0e16f1)): ?>
<?php $component = $__componentOriginala124c3bc37ece30a28542c79ab0e16f1; ?>
<?php unset($__componentOriginala124c3bc37ece30a28542c79ab0e16f1); ?>
<?php endif; ?>
            <div class="setup-bank-form-item">
                <label class="photo-uploaded center-text w-100">
                    <div class="photo-uploaded-flex d-flex uploadImage">
                        <div class="photo-uploaded-icon"><i class="fa-solid fa-paperclip"></i></div>
                        <span class="photo-uploaded-para" id="attachmentText"><?php echo e(__('Add attachments')); ?></span>
                        
                        <button type="button" class="btn btn-sm btn-light ml-2" id="clearAttachment"
                            style="display:none;">
                            <i class="fa-solid fa-times"></i> 
                        </button>
                    </div>
                    <input class="photo-uploaded-file inputTag" type="file" name="attachment" id="attachment">
                </label>
                <?php if(get_static_option('file_extensions')): ?>
                    <p class="mt-2">
                        <?php echo e(__('Supported files:')); ?>

                        <?php echo e(implode(', ', json_decode(get_static_option('file_extensions'), true))); ?>

                    </p>
                <?php endif; ?>
            </div>

            
            <div id="selectedFileNameDisplay" class="mt-2" style="display:none;">
                <span><?php echo e(__('Selected file:')); ?> <strong id="fileName"></strong></span>
                <button type="button" class="btn btn-sm btn-danger ml-2" id="clearAttachmentButton">
                    <i class="fa-solid fa-trash-alt"></i> 
                    <?php echo e(__('Remove')); ?>

                </button>
            </div>
        </div>
    </div>
</div>
<!-- Budget, Skills Ends -->


<script>
    // $(document).on('change', '#attachment', function(){
    //         let uploadImage = document.querySelector(".uploadImage");
    //         let file = document.querySelector(".inputTag").files[0];
    //         if (uploadImage && file) {
    //             uploadImage.innerText = file.name;
    //         }
    //     });
    document.addEventListener('DOMContentLoaded', function() {
        const attachmentInput = document.getElementById('attachment');
        const attachmentText = document.getElementById('attachmentText');
        const clearAttachmentButton = document.getElementById('clearAttachmentButton');
        const selectedFileNameDisplay = document.getElementById('selectedFileNameDisplay');
        const fileNameSpan = document.getElementById('fileName');
        const originalAttachmentText = attachmentText.textContent; // Store original text

        function updateAttachmentDisplay() {
            if (attachmentInput.files.length > 0) {
                const fileName = attachmentInput.files[0].name;
                fileNameSpan.textContent = fileName;
                selectedFileNameDisplay.style.display = 'block'; // Show filename and remove button
                attachmentText.style.display = 'none'; // Hide "Add attachments" text
            } else {
                fileNameSpan.textContent = '';
                selectedFileNameDisplay.style.display = 'none'; // Hide filename and remove button
                attachmentText.style.display = 'inline'; // Show "Add attachments" text
            }
        }

        // Listen for when a file is selected
        attachmentInput.addEventListener('change', updateAttachmentDisplay);

        // Listen for when the clear button is clicked
        clearAttachmentButton.addEventListener('click', function() {
            attachmentInput.value = ''; // Clear the selected file
            updateAttachmentDisplay(); // Update the display
        });

        // Initial check in case there's a pre-filled value (less common for file inputs)
        updateAttachmentDisplay();
    });

</script>
<?php /**PATH /home/piks/Documents/rmwork-zv/core/resources/views/frontend/user/client/job/create/job-budget.blade.php ENDPATH**/ ?>