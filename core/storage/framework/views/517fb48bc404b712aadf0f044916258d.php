<div class="single-input">
    <label class="label-title"><?php echo e($title); ?></label>
    <select name="<?php echo e($name ?? ''); ?>" id="<?php echo e($id ?? ''); ?>" class="form-control get_country_state state_select2">
        <option value=""><?php echo e(__('Select State')); ?></option>
        <?php if(!empty(Auth::guard('web')->user()->country_id)): ?>
            <?php $__currentLoopData = $all_states = \Modules\CountryManage\Entities\State::where('country_id',Auth::guard('web')->user()->country_id)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($state->id); ?>" <?php if(Auth::guard('web')->check() && $state->id == Auth::guard('web')->user()->state_id): ?> selected <?php endif; ?>><?php echo e($state->state); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <?php $__currentLoopData = $all_states = \Modules\CountryManage\Entities\State::all_states(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($state->id); ?>" <?php if(Auth::guard('web')->check() && $state->id == Auth::guard('web')->user()->state_id): ?> selected <?php endif; ?>><?php echo e($state->state); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </select>
    <span class="state_info"></span>
</div>
<?php /**PATH /home/piks/Documents/rmwork-zv/core/resources/views/components/form/state-dropdown.blade.php ENDPATH**/ ?>