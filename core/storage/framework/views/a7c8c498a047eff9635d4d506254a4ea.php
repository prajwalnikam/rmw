
<?php $all_levels = \App\Models\ExperienceLevel::where('status',1)->get() ?>

<?php if($all_levels->count() >= 1): ?>
<div class="single-flex-input">
    <div class="single-input">
        <label class="label-title"><?php echo e($title ?? ''); ?></label>
        <select name="level" id="level" class="<?php echo e($class ?? 'form-control'); ?>">
            <option value=""><?php echo e(__('Select')); ?></option>
            <?php $__currentLoopData = $all_levels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $level): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($level->level); ?>"><?php echo e($level->level); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>
<?php else: ?>
    <div class="single-flex-input">
        <div class="single-input">
            <label class="label-title"><?php echo e($title ?? ''); ?></label>
            <select name="level" id="level" class="<?php echo e($class ?? 'form-control'); ?>">
                <option value=""><?php echo e(__('Select')); ?></option>
                <option value="junior"><?php echo e(__('Junior')); ?></option>
                <option value="midLevel"><?php echo e(__('MidLevel')); ?></option>
                <option value="senior"><?php echo e(__('Senior')); ?></option>
                <option value="not mandatory"><?php echo e(__('Not Mandatory')); ?></option>
            </select>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/piks/Documents/rmwork-zv/core/resources/views/components/form/experience-level-dropdown.blade.php ENDPATH**/ ?>